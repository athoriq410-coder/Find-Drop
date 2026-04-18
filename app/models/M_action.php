<?php
class M_action
{
   var $attr = [];
   public function __construct()
   {
      $this->db = new Database;
      $this->attr = ['>','>=','<','<=','!='];
   }

   public function get_single($tabel, $where = [],$select = '*'){
      $query = '';
      $query .= 'SELECT '.$select;
      $query .= ' FROM `'.$tabel.'`';
      if (count($where) > 0) {
         $query .= ' WHERE ';
         $query .= $this->_where_system($where);
      }
      // var_dump($query);die;
      $this->db->query($query);
      $this->_bind_system($where);

      return $this->db->single();
   }


   public function get_all($tabel, $where = [],$select = '*'){
      $query = '';
      $query .= 'SELECT '.$select;
      $query .= ' FROM '.$tabel;
      if (count($where) > 0) {
         $query .= ' WHERE ';
         $query .= $this->_where_system($where);
         $this->db->query($query);
         $this->_bind_system($where);
      }
      return $this->db->resultSet();
   }


   public function get_where_params($tabel, $where = [], $select = "*", $params = []){
      // var_dump($params);die;
      $query = '';
      $query .= 'SELECT '.$select;
      $query .= ' FROM `'.$tabel.'`';
      if (isset($params['arrjoin'])) {
         foreach ($params['arrjoin'] as $table => $statement) {
            $type = (isset($statement['type']) && $statement['type'] != '') ? $statement['type'] : 'INNER';
            // $this->db->join($table, $statement['statement'], $type);
            $query .= ' '.$type.' JOIN '.$table.' ON '.$statement['statement'];
         }
      }
      if (count($where) > 0 || isset($params['columnsearch']) && count($params['columnsearch']) > 0) {
         $query .= ' WHERE ';
      }
      
      $query .= $this->_where_system($where);

      if (isset($params['search']) && !empty($params['search'])) {
         
         if (count($params['columnsearch']) > 0) {
            $i = 1;
            if (count($where) > 0) {
               $query .= ' AND (';
            }else{
                $query .= ' (';
            }
            foreach ($params['columnsearch'] as $columnname) {
               if ($i == 1) {
                  $query .= " ".$columnname." LIKE '%".$params["search"]."%' ESCAPE '!'";
               } else {
                  $query .= " OR ".$columnname." LIKE '%".$params["search"]."%' ESCAPE '!'";
               }
               $i++;
            }
            $query .= ")";
         }
      }

      if (isset($params['groupby'])) {
         $query .= ' GROUP BY '.$params['groupby'];
      }

      if (isset($params['sort'])) {
         if ($params['sort'] != '') {
            if ($params['order'] == '') {
               $order = 'asc';
            } else {
               $order = $params['order'];
            }
            $query .= ' ORDER BY '.$params['sort'].' '.$order;
         }
      }

      if (isset($params['limit'])) {
         $query .= ' LIMIT '.$params['limit'];
         if (isset($params['offset'])) {
            $query .= ' OFFSET '.$params['offset'];
         }
      }
      // var_dump($query);die;
      $this->db->query($query);
      $this->_bind_system($where);
      return $this->db->resultSet();
   }

   public function insert($tabel,$in = [])
   {
      $query = '';
      $query .= 'INSERT INTO `'.$tabel.'` ';
      if (count($in) > 0) {
         $query .= '(';
         $no =0;
         foreach ($in as $key => $value) {
            $num = $no++;
            if ($num > 0) {
               $query .= ',`'.$key.'`';
            }else{
               $query .= '`'.$key.'`';
            }
         }
         $query .= ') ';
         $query .= 'VALUES (';
         $no =1;
         foreach ($in as $key => $value) {
            $num = $no++;
            $v = 'v'.$num;
            if ($num > 1) {
               $query .= ',:'.$v;
            }else{
               $query .= ':'.$v;
            }
         }
         $query .= ')';
        
      }
      // var_dump($query);die;
      $this->db->query($query);
      $this->_bind_system($in);
      return $this->db->insert_id();
   }

   public function update($tabel,$set = [],$where = [])
   {
      $query = '';
      $query .= 'UPDATE `'.$tabel.'` SET ';
      if (count($set) > 0) {
         $start = count($where) + 1;
         $no = $start;
         foreach ($set as $key => $value) {
            $num = $no++;
            $v = 'v'.$num;
            if ($num > $start) {
               $query .= ',`'.$key.'` = :' . $v;
            }else{
               $query .= '`'.$key.'` = :'.$v;
            }
         }
         if (count($where) > 0) {
            $query .= ' WHERE ';
            $query .= $this->_where_system($where);
         }
         
      }
      // var_dump($query);die;
      $this->db->query($query);
      $this->_bind_system($where);
      if (count($set) > 0) {
         $vn = $start;
         foreach ($set as $row => $value) {
            
               if (!is_array($value) && $value !== NULL && $row != 'query') {
               $vnum = $vn++;
               $v = 'v'.$vnum;
               $this->db->bind($v,$value);
            } 
         }
      }
      return $this->db->execute();
   }

   public function delete($tabel,$where = [])
   {
      $query = '';
      $query .= 'DELETE FROM `'.$tabel.'` ';
      if (count($where) > 0) {
         $query .= ' WHERE ';
         $query .= $this->_where_system($where);
      }
      // var_dump($query);die;
      $this->db->query($query);
      $this->_bind_system($where);
      return $this->db->execute();
   }

   

   private function _where_system($where = [])
   {
      $result = '';
      if (count($where) > 0) {
         $no = 1;
         $vn = 1;
         foreach ($where as $row => $value) {
            $num = $no++;
            if ($num > 1) {
               $result .= ' AND ';
            }
            if ($row == 'query') {
               foreach ($value as $q) {
                  $result .= ' '.$q;
               }
            }else{
               $cr = explode(" ",$row);
               $s = '=';
               $d = '';
               if (isset($cr[1])) {
                  if (in_array(trim($cr[1]),$this->attr)) {
                     $s = trim($cr[1]);
                     if (in_array($s,['!','!='])) {
                        $d = ' NOT';
                     }
                     
                  }
               }
               if (is_array($value)) {
                  
                  $bts = $d.' IN ('.implode(",",$value).')';
               }else{
                  if ($value == NULL) {
                     $bts = ' IS NULL';
                  }else{
                     $vnum = $vn++;
                     $v = 'v'.$vnum;
                     $bts = $s.':'.$v;
                  }
                  
               }
               $r = str_replace(['(',')'],'|',$cr[0]);
               $field = '';
               if (strpos($r,"|")) {
                  $ct = explode('|',$r);
                  $attr = $ct[0];
                  $field .= $attr.'(';
                  $cb = explode('.',$ct[1]);
               
                  $field .= '`'.$cb[0].'`';
                  if (isset($cb[1])) {
                     $field .= '.`'.$cb[1].'`';
                  }
                  $field .= ')';
               }else{
                  $ct = explode('.',$r);
                  $field .= '`'.$ct[0].'`';
                  if (isset($ct[1])) {
                     $field .= '.`'.$ct[1].'`';
                  }
               }  
               
               $result .= $field.$bts;
            }
            
         }
      }

      return $result;
   }

   private function _bind_system($arr = [])
   {
      if (count($arr) > 0) {
         $vn = 1;
         foreach ($arr as $row => $value) {
            
            if (!is_array($value) && $value != NULL && $row != 'query') {
               $vnum = $vn++;
               $v = 'v'.$vnum;
               $this->db->bind($v,$value);
            } 
         }
      }
   }

}
