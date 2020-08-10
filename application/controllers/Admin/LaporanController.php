<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in' !== TRUE)) {
			redirect('/');
		}
	}

	public function findSetoran()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Laporan"
			);
			$this->load->view('pages/Admin/laporan/findSetoran.php', $data);
		} else {
			redirect('/');
		}
	}

	public function findPenunggakan()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Laporan"
			);
			$this->load->view('pages/Admin/laporan/findPenunggakan.php', $data);
		} else {
			redirect('/');
		}
	}

	public function findSetoran_()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');


		if ($bulan && $tahun) {
			$data = array(
				'title' => "Data Laporan"
			);
			$data['bulan']				= $bulan;
			$data['tahun']				= $tahun;
			$data['admin']	 			= $this->db->query("SELECT * FROM setoran INNER JOIN pedagang ON setoran.id_pedagang = pedagang.id_pedagang WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->result();

			$this->load->view('pages/Admin/laporan/setoran.php', $data);
		}
	}

	public function findPenunggakan_()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');


		if ($bulan && $tahun) {
			$data = array(
				'title' => "Data Laporan"
			);
			$data['bulan']				= $bulan;
			$data['tahun']				= $tahun;
			$data['admin']	 			= $this->db->query("SELECT * FROM penunggakan INNER JOIN pedagang ON penunggakan.id_pedagang = pedagang.id_pedagang WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->result();

			$this->load->view('pages/Admin/laporan/penunggakan.php', $data);
		}
	}

	public function print_setoran()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		if ($bulan && $tahun) {
			$data	 			= $this->db->query("SELECT * FROM setoran INNER JOIN pedagang ON setoran.id_pedagang = pedagang.id_pedagang WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->result();
		}
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Laporan');
		$pdf->SetPrintFooter(false);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetHeaderData(0, 0, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetFont('times', '', 10);
		$pdf->AddPage();
		$pdf->setCellPaddings(1, 1, 1, 1);
		$pdf->setCellMargins(1, 1, 1, 1);
		$pdf->SetFillColor(255, 255, 127);
		$pdf->WriteHTMLCell(0, 0, '', '', '', 0, 1, 0, true, 'C', true);
		$html = 'Periode : ' . $bulan . '-' . $tahun;
		$pdf->writeHTML($html, true, false, true, false, '');
		$table = '<table stripped style="border:1px solid #ddd;padding:4px;">';
		$table .= '<tr align="cent" bgcolor="#ccc">
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="90px">Nama</th>
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="80px">Alamat</th>
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="80px">Tempat Dagang</th>						
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="80px">Tanggal Setoran</th>						
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="70px">Keterangan</th>						
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="100px">Jumlah</th>						
					</tr>';
		if (!empty($data)) {
			foreach ($data as $row) {
				$originalDate = $row->tanggal;
				$newDate = date("d M Y", strtotime($originalDate));
				$table .= '<tr align="left">
							<td style="border:1px solid #ddd;">' . $row->nama_pedagang . '</td>						
							<td style="border:1px solid #ddd;">' . $row->alamat . '</td>
							<td style="border:1px solid #ddd;">' . $row->nama_tempat . '</td>
							<td style="border:1px solid #ddd;">' . $newDate . '</td>
							<td style="border:1px solid #ddd;">' . $row->ket . '</td>
							<td style="border:1px solid #ddd;">' . 'Rp. ' . rupiah($row->jumlah) . '</td>
						</tr>';
			}
		} else {
			echo "
				<script>
					alert('Data Kosong');
					history.go(-1);
				</script>
			";
		}
		$table .= '</table>';
		$pdf->WriteHTMLCell(0, 0, 15, '', $table, 0, 1, 0, true, 'C', true);
		$subtotal = 0;
		foreach ($data as $row) {
			$subtotal += $row->jumlah;
			$table = '<table style="padding:4xpx;">';
			$table .= '<tr>
							<th>Total</th>
							<td>' . 'Rp. ' . rupiah($subtotal) . '</td>
						</tr>';
			$table .= '</table>';
		}
		$pdf->WriteHTMLCell(0, 0, 125, '', $table, 0, 1, 0, true, 'R', true);

		$pdf->lastPage();
		// ob_clean();
		$pdf->Output('Laporan-SewaAmbulance-' . $bulan . '.pdf', 'I');
	}

	public function print_penunggakan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		if ($bulan && $tahun) {
			$data	 			= $this->db->query("SELECT * FROM penunggakan INNER JOIN pedagang ON penunggakan.id_pedagang = pedagang.id_pedagang WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->result();
		}
		$pdf = new Pdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Laporan');
		$pdf->SetPrintFooter(false);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetHeaderData(0, 0, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetFont('times', '', 10);
		$pdf->AddPage();
		$pdf->setCellPaddings(1, 1, 1, 1);
		$pdf->setCellMargins(1, 1, 1, 1);
		$pdf->SetFillColor(255, 255, 127);
		$pdf->WriteHTMLCell(0, 0, '', '', '', 0, 1, 0, true, 'C', true);
		$html = 'Periode : ' . $bulan . '-' . $tahun;
		$pdf->writeHTML($html, true, false, true, false, '');
		$table = '<table stripped style="border:1px solid #ddd;padding:4px;">';
		$table .= '<tr align="cent" bgcolor="#ccc">
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="100px">Nama</th>
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="100px">Alamat</th>
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="100px">Tempat Dagang</th>						
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="100px">Tanggal</th>					
						<th style="border:1px solid #ddd;background-color:#B8DAFF" width="100px">Jumlah</th>						
					</tr>';
		if (!empty($data)) {
			foreach ($data as $row) {
				$originalDate = $row->tanggal;
				$newDate = date("d M Y", strtotime($originalDate));
				$table .= '<tr align="left">
							<td style="border:1px solid #ddd;">' . $row->nama_pedagang . '</td>						
							<td style="border:1px solid #ddd;">' . $row->alamat . '</td>
							<td style="border:1px solid #ddd;">' . $row->nama_tempat . '</td>
							<td style="border:1px solid #ddd;">' . $newDate . '</td>
							<td style="border:1px solid #ddd;">' . 'Rp. ' . rupiah($row->bayar) . '</td>
						</tr>';
			}
		} else {
			echo "
				<script>
					alert('Data Kosong');
					history.go(-1);
				</script>
			";
		}
		$table .= '</table>';
		$pdf->WriteHTMLCell(0, 0, 15, '', $table, 0, 1, 0, true, 'C', true);
		$subtotal = 0;
		foreach ($data as $row) {
			$subtotal += $row->bayar;
			$table = '<table style="padding:4xpx;">';
			$table .= '<tr>
							<th>Total</th>
							<td>' . 'Rp. ' . rupiah($subtotal) . '</td>
						</tr>';
			$table .= '</table>';
		}
		$pdf->WriteHTMLCell(0, 0, 125, '', $table, 0, 1, 0, true, 'R', true);

		$pdf->lastPage();
		// ob_clean();
		$pdf->Output('Laporan-SewaAmbulance-' . $bulan . '.pdf', 'I');
	}
}
