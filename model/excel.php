<?php

class Excel2007 {
	public $objPHPExcel;
	
	/**
	 * 
	 * <b>include the followig files:</b><br>
	 * include '../model/excel.php';
	 * include '../excel/PHPExcel.php';
	 * include '../excel/PHPExcel/Writer/Excel2007.php';
	 */
	function __construct() {
		$this->objPHPExcel = new PHPExcel();
	}
	
	public function setProperties($creator, $title) {
		$this->objPHPExcel->getProperties()->setCreator($creator);
		$this->objPHPExcel->getProperties()->setTitle($title);
	}
	
	public function addData($data) {
		$sheetIndex = 0;
		foreach ($data as $sheetTitle => $value) {
			$this->objPHPExcel->setActiveSheetIndex($sheetIndex);
			$this->objPHPExcel->getActiveSheet()->setTitle($sheetTitle);
			
			foreach ($value as $row => $datas) {
				if ($row != 0) {
					foreach ($datas as $column => $data) {
						$this->objPHPExcel->getActiveSheet()->SetCellValue($column . $row, $data);
						$this->objPHPExcel->getActiveSheet()->getStyle($column . $row)->
						getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						
						if ($row == 1) {
							$this->objPHPExcel->getActiveSheet()->getStyle($column . $row)->
							getFont()->setBold(true);
							
							$this->objPHPExcel->getActiveSheet()->getColumnDimension($column)->
							setAutoSize(true);
						}
					}
				}
			}
			
			$sheetIndex++;
			$this->objPHPExcel->createSheet(null, $sheetIndex);
		}
		$this->objPHPExcel->removeSheetByIndex($sheetIndex);
	}
	
	public function outputFile() {
		$objWriter = new PHPExcel_Writer_Excel2007($this->objPHPExcel);
		$objWriter->save('php://output');
	}
	
	public function saveFile($filename) {
		$objWriter = new PHPExcel_Writer_Excel2007($this->objPHPExcel);
		$objWriter->save($filename . '.xlsx');
	}
}

?>
