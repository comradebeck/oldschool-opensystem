<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php
	if (!class_exists('clsTable')) {
		class clsTable {
			var $vTableAttribs;				// Array
			var $vTHeadAttribs;				// Array
			var $vTHeadTRAttribs;			// Array
			var $vTHeadTDAttribs;			// Array
			
			var $vTBodyAttribs;				// Array
			var $vTBodyTRAttribs;			// Array
			var $vTBodyTDAttribs;			// Array
			
			var $vColHeaders;				// Array
			var $vRows;						// Array [row][column];
			var $vNumRows;
			var $vNumCols;
			
			function clsTable() {
				$this->vTableAttribs		= array('id="idListView"');
				$this->vTHeadAttribs		= array();
				$this->vTHeadTRAttribs		= array();
				$this->vTHeadTDAttribs		= array();
				
				$this->vTBodyAttribs		= array();
				$this->vTBodyTRAttribs		= array();
				$this->vTBodyTDAttribs		= array();
				
				$this->vColHeaders			= array('ID', 'Date Added', 'Added By', 'Control');
				$this->vRows				= array();
				$this->vNumRows				= 0;
				$this->vNumCols				= 0;
			}

			function fCreateTable() {
				$vTable = '<table';
				if ($this->vTableAttribs) foreach ($this->vTableAttribs as $vKey) $vTable .= ' '.$vKey;
				$vTable .= '><thead';
				if ($this->vTHeadAttribs) foreach ($this->vTHeadAttribs as $vKey) $vTable .= ' '.$vKey;
				$vTable .= ">\r\n<tr";
				if ($this->vTHeadTRAttribs) foreach ($this->vTHeadTRAttribs as $vKey) $vTable .= ' '.$vKey;
				$vTable .= ">\r\n";				
				foreach ($this->vColHeaders as $vKey) {
					$vTable .= '<td';
					if ($this->vTHeadTDAttribs) foreach ($this->vTHeadTDAttribs as $vCol) $vTable .= ' '.$vCol;
					$vTable .= '><strong>'.$vKey."</strong></td>\r\n";
				}
				$vTable .= "</tr>\r\n</thead>\r\n<tbody";
				if ($this->vTHeadAttribs) foreach ($this->vTHeadAttribs as $vKey) $vTable .= ' '.$vKey;
				$vTable .= ">\r\n";				
				
				for ($vR=0; $r<$this->vNumRows; $vR++ ){
					$vTable .= "<tr>\r\n";
					for ( $vC=0; $vC<$this->vNumCols; $vC++ ){
						$vTable .= "<td>" . $this->vRows[$vR][$vC] . "</td>\r\n";
					}
					$vTable .= "</tr>\r\n";
				}						
				$vTable .= "</tbody>\r\n
						<tfoot>\r\n
							<tr>\r\n
							</tr>\r\n
						</tfoot>\r\n
					</table>";
				return $vTable;
			}
			
			function fAddRow($vRowData) {
				for ($vLoop=0; $vLoop!=$this->vNumCols; $i++ ) {
					if ($vRowData[$vLoop]) {
						$this->vRows[$this->vNumRows][$vLoop] = $vRowData[$vLoop];
					} else {
						$this->vRows[$this->vNumRows][$vLoop] = "&nbsp;";
					}
                }
                $this->vNumRows++;				
			}			
		}
	}
?>