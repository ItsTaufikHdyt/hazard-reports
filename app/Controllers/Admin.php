<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\HazardsModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    protected $user, $hazard;

    function __construct()
    {
        $this->user = new UsersModel();
        $this->hazard = new HazardsModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        echo view('admin/dashboard');
    }

    public function user()
    {
        $user = new UsersModel();
        $data = [
            'datax' => $user->paginate(10),
            'pager' => $user->pager,
        ];
        echo view('admin/user/index', $data);
    }

    public function addUser()
    {
        echo view('admin/user/add');
    }

    public function storeUser()
    {
        if (!$this->validate(
            [

                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Usernmae field can not be blank value'
                    ]
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Name field can not be blank value'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The role field can not be blank value'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The password field can not be blank value'
                    ]
                ]
            ]
        )) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        };
        $this->user->insert([
            'username' => $this->request->getVar('username'),
            'name' => $this->request->getVar('name'),
            'role' => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);
        return redirect()->to(url_to('adminUser'));
    }

    public function editUser($id)
    {
        $dataUser = $this->user->find($id);
        $data['user'] = $dataUser;
        echo view('admin/user/edit', $data);
    }

    public function updateUser($id)
    {
        if (!$this->validate(
            [

                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Usernmae field can not be blank value'
                    ]
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Name field can not be blank value'
                    ]
                ],
                'role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The role field can not be blank value'
                    ]
                ],
            ]
        )) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        };
        if (empty($this->request->getVar('password'))) {
            $this->user->update($id, [
                'username' => $this->request->getVar('username'),
                'name' => $this->request->getVar('name'),
                'role' => $this->request->getVar('role'),
            ]);
        } else {
            $this->user->update($id, [
                'username' => $this->request->getVar('username'),
                'name' => $this->request->getVar('name'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            ]);
        }
        return redirect()->to(url_to('adminUser'));
    }

    public function deleteUser($id)
    {
        $this->user->delete($id);
        return redirect()->to(url_to('adminUser'));
    }

    public function hazard()
    {
        $hazard = new HazardsModel();
        $data = [
            'datax' => $hazard->paginate(10),
            'pager' => $hazard->pager,
        ];
        return view('admin/hazard/index', $data);
    }

    public function addHazard()
    {
        session();
        $data = [
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/hazard/add', $data);
    }

    public function storeHazard()
    {
        if (!$this->validate(
            [
                'tgl_lapor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Tanggal Laporan field can not be blank value'
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Nama field can not be blank value'
                    ]
                ],
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The nip field can not be blank value'
                    ]
                ],
                'section' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The section field can not be blank value'
                    ]
                ],
                'lokasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The lokasi field can not be blank value'
                    ]
                ],
                'jenis_bahaya' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The jenis bahaya field can not be blank value'
                    ]
                ],
                'uraian_bahaya' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Uraian Bahaya field can not be blank value'
                    ]
                ],
                'penyebab' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The penyebab field can not be blank value'
                    ]
                ],
                'tindakan_perbaikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Tindakan Perbaikan field can not be blank value'
                    ]
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Status Perbaikan field can not be blank value'
                    ]
                ],
            ]
        )) {
            session()->setFlashdata('error', $this->validator->listErrors());
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput();
        };
        $dataImg = $this->request->getFile('foto');
        $fileName = $dataImg->getRandomName();
        $tess = $this->hazard->insert([
            'tgl_lapor' => $this->request->getVar('tgl_lapor'),
            'nama' => $this->request->getVar('nama'),
            'nip' => $this->request->getVar('nip'),
            'section' => $this->request->getVar('section'),
            'lokasi' => $this->request->getVar('lokasi'),
            'jenis_bahaya' => $this->request->getVar('jenis_bahaya'),
            'uraian_bahaya' => $this->request->getVar('uraian_bahaya'),
            'penyebab' => $this->request->getVar('penyebab'),
            'tindakan_perbaikan' => $this->request->getVar('tindakan_perbaikan'),
            'status' => $this->request->getVar('status'),
            'foto' => $fileName,
            'id_user' => session()->get('id')
        ]);
        $dataImg->move('uploads/foto/', $fileName);
        return redirect()->to(url_to('adminHazard'));
    }

    public function editHazard($id)
    {
        $dataHazard = $this->hazard->find($id);
        $data['hazard'] = $dataHazard;
        echo view('user/hazard/edit', $data);
    }

    public function updateHazard($id)
    {
        if (!$this->validate(
            [
                'tgl_lapor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Tanggal Laporan field can not be blank value'
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Nama field can not be blank value'
                    ]
                ],
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The nip field can not be blank value'
                    ]
                ],
                'section' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The section field can not be blank value'
                    ]
                ],
                'lokasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The lokasi field can not be blank value'
                    ]
                ],
                'jenis_bahaya' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The jenis bahaya field can not be blank value'
                    ]
                ],
                'uraian_bahaya' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Uraian Bahaya field can not be blank value'
                    ]
                ],
                'penyebab' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The penyebab field can not be blank value'
                    ]
                ],
                'tindakan_perbaikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Tindakan Perbaikan field can not be blank value'
                    ]
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Status Perbaikan field can not be blank value'
                    ]
                ],
            ]
        )) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        };
        if ($this->request->getFile('foto') !== null) {
            $dataHazard = $this->hazard->find($id);
            $img = $dataHazard->foto;
            $path = './uploads/foto/';
            @unlink($path . $img);

            $dataImg = $this->request->getFile('foto');
            $fileName = $dataImg->getRandomName();
            $this->hazard->update($id, [
                'tgl_lapor' => $this->request->getVar('tgl_lapor'),
                'nama' => $this->request->getVar('nama'),
                'nip' => $this->request->getVar('nip'),
                'section' => $this->request->getVar('section'),
                'lokasi' => $this->request->getVar('lokasi'),
                'jenis_bahaya' => $this->request->getVar('jenis_bahaya'),
                'uraian_bahaya' => $this->request->getVar('uraian_bahaya'),
                'penyebab' => $this->request->getVar('penyebab'),
                'tindakan_perbaikan' => $this->request->getVar('tindakan_perbaikan'),
                'status' => $this->request->getVar('status'),
                'foto' => $fileName,
                'id_user' => session()->get('id')
            ]);
            $dataImg->move('uploads/foto/', $fileName);
        } else {
            $this->hazard->update($id, [
                'tgl_lapor' => $this->request->getVar('tgl_lapor'),
                'nama' => $this->request->getVar('nama'),
                'nip' => $this->request->getVar('nip'),
                'section' => $this->request->getVar('section'),
                'lokasi' => $this->request->getVar('lokasi'),
                'jenis_bahaya' => $this->request->getVar('jenis_bahaya'),
                'uraian_bahaya' => $this->request->getVar('uraian_bahaya'),
                'penyebab' => $this->request->getVar('penyebab'),
                'tindakan_perbaikan' => $this->request->getVar('tindakan_perbaikan'),
                'status' => $this->request->getVar('status'),
                'id_user' => session()->get('id')
            ]);
        }
        return redirect()->to(url_to('adminHazard'));
    }

    public function deleteHazard($id)
    {
        $dataHazard = $this->hazard->find($id);
        $img = $dataHazard->foto;
        $path = './uploads/foto/';
        @unlink($path . $img);

        $this->hazard->delete($id);
        return redirect()->to(url_to('adminHazard'));
    }

    public function exportHazardExcel()
    {
        $hazard = new HazardsModel();
        $reportHazard = $hazard->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal Laporan')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'NIP')
            ->setCellValue('D1', 'Section')
            ->setCellValue('E1', 'Lokasi')
            ->setCellValue('F1', 'Jenis Bahaya')
            ->setCellValue('G1', 'Uraian Bahaya')
            ->setCellValue('H1', 'Penyebab')
            ->setCellValue('I1', 'Tindakan Perbaikan')
            ->setCellValue('J1', 'Status');

        $column = 2;
        // tulis data mobil ke cell

        foreach ($reportHazard as $data) {
            if ($data->status == 1) {
                $status = 'Open';
            } else {
                $status = 'Close';
            }

            if ($data->jenis_bahaya == 1) {
                $jenis_bahaya = 'Tindakan Tidak Aman';
            } else {
                $jenis_bahaya = 'Kondisi Tidak aman';
            }
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data->tgl_lapor)
                ->setCellValue('B' . $column, $data->nama)
                ->setCellValue('C' . $column, $data->nip)
                ->setCellValue('D' . $column, $data->section)
                ->setCellValue('E' . $column, $data->lokasi)
                ->setCellValue('F' . $column, $jenis_bahaya)
                ->setCellValue('G' . $column, $data->uraian_bahaya)
                ->setCellValue('H' . $column, $data->penyebab)
                ->setCellValue('I' . $column, $data->tindakan_perbaikan)
                ->setCellValue('J' . $column, $status);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Hazard Report';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
