<?php
	if (!class_exists('Database')) {
		class PS_Pagination {
			var $php_self;
			var $rows_per_page;
			var $total_rows;
			var $links_per_page;
			var $sql;
			var $debug = true;
			var $conn;
			var $page;
			var $max_pages;
			var $offset;
			var $sorturl;
			var $sorturlmaxpages;
			 
			function PS_Pagination($connection, $sql, $rows_per_page = 5, $links_per_page = 10,$pagename='') {
				$this->conn = $connection;
				$this->sql = $sql;
				$this->rows_per_page = $rows_per_page;
				$this->links_per_page = $links_per_page;
				$this->php_self = htmlspecialchars($_SERVER['PHP_SELF']);
				if(isset($_GET['page'])) {
					$this->page = intval($_GET['page']);
				}
				
				$pagename = substr($pagename, 0, -3);
				if ($_SESSION[$pagename]=='') {
					if($_REQUEST['maxpages']!='') {
						$_SESSION[$pagename] = $_REQUEST['maxpages'];
						$this->rows_per_page = $_SESSION[$pagename];
						$this->sorturlmaxpages ='&maxpages='.$this->rows_per_page;
					} 
				} else {
					if($_REQUEST['maxpages']!='') {
						$_SESSION[$pagename] = $_REQUEST['maxpages'];				
					}
					$this->rows_per_page = $_SESSION[$pagename];
					$this->sorturlmaxpages ='&maxpages='.$this->rows_per_page;
				}
					
			}
			function paginate() {
				if(!$this->conn) {
					if($this->debug) echo "MySQL connection missing<br />";
					return false;
				}
				
				$all_rs = @mysql_query($this->sql,$this->conn);
				if(!$all_rs) {
					if($this->debug) echo "SQL query failed. Check your query.<br />";
					return false;
				}
				$this->total_rows = mysql_num_rows($all_rs);
				@mysql_close($all_rs);
				
				$this->max_pages = ceil($this->total_rows/$this->rows_per_page);
				if($this->page > $this->max_pages || $this->page <= 0) {
					$this->page = 1;
				}
				$this->offset = $this->rows_per_page * ($this->page-1);
				$rs = @mysql_query($this->sql." LIMIT {$this->offset}, {$this->rows_per_page}",$this->conn);
				if(!$rs) {
					if($this->debug) echo "Pagination query failed. Check your query.<br />";
					return false;
				}
				return $rs;
			}
			function renderFirst($tag='First') {
				if($this->page == 1) {
					return $tag;
				}
				else {
					return '<a href="'.$this->php_self.'?page=1'.$this->sorturl.$this->sorturlmaxpages.'" title="First">'.$tag.'</a>';
				}
			}
			function renderLast($tag='Last') {
				if($this->page == $this->max_pages) {
					return $tag;
				}
				else {
					return '<a href="'.$this->php_self.'?page='.$this->max_pages.$this->sorturl.$this->sorturlmaxpages.'" title="Last">'.$tag.'</a>';
				}
			}
			function renderNext($tag=' &raquo;') {
				if($this->page < $this->max_pages) {
					return '<a href="'.$this->php_self.'?page='.($this->page+1).$this->sorturl.$this->sorturlmaxpages.'" title="Next">'.$tag.'</a>';
				}
				else {
					return $tag;
				}
			}
			function renderPrev($tag='&laquo;') {
				if($this->page > 1) {
					return '<a href="'.$this->php_self.'?page='.($this->page-1).$this->sorturl.$this->sorturlmaxpages.'" title="Previous">'.$tag.'</a>';
				}
				else {
					return $tag;
				}
			}
			function renderNav() {
				for($i=1;$i<=$this->max_pages;$i+=$this->links_per_page) {
					if($this->page >= $i) {
						$start = $i;
					}
				}		
				if($this->max_pages > $this->links_per_page) {
					$end = $start+$this->links_per_page;
					if($end > $this->max_pages) 
					$end = $this->max_pages+1;
				} else {
					$end = $this->max_pages+1;
				}			
				$links = '';		
				for( $i=$start ; $i<$end ; $i++) {
					if($i == $this->page) {
						$links .= " $i ";
					} else {
						$links .= ' <a href="'.$this->php_self.'?page='.$i.$this->sorturl.$this->sorturlmaxpages.'">'.$i.'</a> ';
					}
					if($links > $this->max_pages)
					$links = $links - 1;
				}
				return $links;
			}
			function renderFullNav() {
				$result = (($this->page - 1) * $this->rows_per_page); //  (page -1) * max per page
				$displayresult = ' <strong style="color:purple;"><em> Displaying result '.($result==0?1:$result+1) .' to '.(($this->rows_per_page*$this->page) >= $this->total_rows? $this->total_rows : $this->rows_per_page*$this->page).' ('.$this->total_rows.' Found)</em></strong>';;
				if ($this->total_rows=='0') {
					$displayresult = ' <strong style="color:red;"><em>No Result</em></strong>';
				}
				$rand = rand();
				$selectnumpages = '
					<form onchange="submit();" name="formpage'.$rand.'" action="'.$this->php_self.'?page='.$i.$this->sorturl.'" method="POST" style="display:inline;">
						<select name="maxpages">
								<option value="'.$this->rows_per_page.'"><em>'.$this->rows_per_page.' Results</em></option>
								<option value="5">5 Results</option>
								<option value="10">10 Results</option>
								<option value="20">20 Results</option>
								<option value="50">50 Results</option>
								<option value="100">100 Results</option>
								<option value="200">200 Results</option>
								<option value="300">300 Results</option>
								<option value="500">500 Results</option>
								<option value="700">700 Results</option>
								<option value="900">900 Results</option>
								<option value="1000">1000 Results</option>
								<option value="1500">1500 Results</option>
								<option value="2000">2000 Results</option>
						</select>
						<input type="submit" value="Show">
					</form>
				';
				return $this->renderFirst().'&nbsp;'.$this->renderPrev().'&nbsp;'.$this->renderNav().'&nbsp;'.$this->renderNext().'&nbsp;'.$this->renderLast().$displayresult.' '.$selectnumpages;	
			}
			function setDebug($debug) {
				$this->debug = $debug;
			}
		}
	}
?>