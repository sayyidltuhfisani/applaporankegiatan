<?php 
	require_once 'Classes/PHPExcel.php';

	$con =mysqli_connect('localhost','root','','excel_coba');
	if(!$con)
	{
		echo mysqli_error($con);
		exit();	
	}

	function cellColor($cells,$color){
		    global $excel;

		    $excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
		        'type' => PHPExcel_Style_Fill::FILL_SOLID,
		        'startcolor' => array(
		             'rgb' => $color
		        )
		    ));
		}



	//membuat object phpexcel
	$excel=new PHPExcel();

	//input data object phpexcel
	/*$excel->setActiveSheetIndex(0)
			->setCellvalue('A1','Hello1')
			->setCellvalue('B1','Hello2');
	*/


	$excel->setActiveSheetIndex(0);

	//menampilkan data database
	$query=mysqli_query($con,"select * from kecamatan");
	$row=4;
	while ($data=mysqli_fetch_array($query)) {
		$excel->getActiveSheet()
			->setCellvalue('A'.$row, $data['id'])
			->setCellvalue('B'.$row, $data['id_kecamatan'])
			->setCellvalue('C'.$row, $data['nama_kecamatan']);
			cellColor('A17:C17', 'F28A8C');
			$row ++;
	}

	//mengatur ukuran kolom
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth('10');
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth('40');


	//membuat judul table
	$excel->getActiveSheet()
			->setCellvalue('A1', 'NAMA-NAMA Kecamatan')
			->setCellvalue('A3', 'ID')
			->setCellvalue('B3', 'ID Kecamatan')
			->setCellvalue('C3', 'Nama Kecamatan');


	//membuat marge
	$excel->getActiveSheet()->mergeCells('A1:C1');

	//align
	$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');	

	//style
	$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
		array(
			'font' => array(
					'size' => 24,

				)
		)
	);

	$excel->getActiveSheet()->getStyle('A3:C3')->applyFromArray(
		array(
			'font' => array(
					'size' => 18,
					'bold' => true,
			),
			'borders' =>array(
					'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			)
		)
	);

	$excel->getActiveSheet()->getStyle('A4:C'.($row-1))->applyFromArray(
		array(
			'borders' =>array(
					'outline' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
					),
					'vertical' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			)
		)
	);	





	


	//untuk mendowload file excel
	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename=reklame.xlsx');
	header('Cache-Control:max-age=0');

	//membuat file excel
	$file=PHPExcel_IOFactory::createWriter($excel,'Excel2007');

	//membuat pengeluaran filename
	$file->save('php://output')






 ?>