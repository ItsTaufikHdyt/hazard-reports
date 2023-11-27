<?php

namespace App\Controllers;

use App\Models\HazardsModel;

class User extends BaseController
{
    protected $hazard;

    function __construct()
    {
        $this->hazard = new HazardsModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        echo view('user/dashboard');
    }

    public function hazard()
    {
        $hazard = new HazardsModel();
        //$id = session()->get('id');
        //$query = $this->db->table('hazards')->where(["id_user" => session()->get('id')])->get()->getResult();
        $data = [
            'datax' => $hazard->where('id_user',session()->get('id'))->paginate(10),
            'pager' => $hazard->pager,
        ];
        echo view('user/hazard/index', $data);
    }

    public function addHazard()
    {
        session();
        $data = [
            'validation' => \Config\Services::validation(),
        ];
        return view('user/hazard/add', $data);
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
        return redirect()->to(url_to('userHazard'));
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
        return redirect()->to(url_to('userHazard'));
    }

    public function deleteHazard($id)
    {
        $dataHazard = $this->hazard->find($id);
        $img = $dataHazard->foto;
        $path = './uploads/foto/';
        @unlink($path . $img);

        $this->hazard->delete($id);
        return redirect()->to(url_to('userHazard'));
    }
}
