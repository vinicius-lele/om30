<?php

namespace App\Controllers;

use App\Models\PacientesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pacientes extends BaseController
{
    public function index(): string
    {
        $model = model(PacientesModel::class);

        $data = [
            'pacientes'  => $model->findAll(),

        ];
        return view('templates/header')
            . view('pacientes/index', $data)
            . view('templates/footer');
    }

    public function new()
    {
        helper('form');

        return view('templates/header')
            . view('pacientes/create')
            . view('templates/footer');
    }

    public function create()
    {
        if (!$this->validate(
            [
                'nome' => 'required',
                'nome_mae' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'cpf_is_valid',
                'cns' => 'cns_is_valid',
                'endereco' => 'required',
                'userfile' => 'ext_in[userfile,png,jpg,gif]',
            ]
        )) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return $this->new();
        }

        $post = $this->validator->getValidated();
        $cpf = preg_replace('/[^0-9]/is', '', $post['cpf']);
        $cns = preg_replace('/[^0-9]/is', '', $post['cns']);
        $model = model(PacientesModel::class);

        if ($this->request->getFile('userfile')->isValid()) {
            $img = $this->request->getFile('userfile');
            $img_name = $img->getRandomName();
            $img_path = '../../public/assets/img';
            $imagem = '/assets/img/' . $img_name;
            if (!$img->hasMoved()) {
                $img->store($img_path, $img_name);
            }
            $model->save([
                'nome' => $this->request->getVar('nome'),
                'nome_mae' => $post['nome_mae'],
                'data_nascimento'  => $post['data_nascimento'],
                'cpf' => $cpf,
                'cns' => $cns,
                'endereco' => $post['endereco'],
                'image' => $imagem,
            ]);
        } else {
            $model->save([
                'nome' => $this->request->getVar('nome'),
                'nome_mae' => $post['nome_mae'],
                'data_nascimento'  => $post['data_nascimento'],
                'cpf' => $cpf,
                'cns' => $cns,
                'endereco' => $post['endereco'],
            ]);
        }

        return $this->response->redirect(site_url('/'));
    }

    public function show($id, $errors = null)
    {
        $model = model(PacientesModel::class);
        $data = [
            'pacientes' => $model->find($id),
            'erros' => $errors
        ];

        if (empty($data['pacientes'])) {
            throw new PageNotFoundException('Não conseguimos encontrar este paciente');
        }

        return view('templates/header', $data)
            . view('pacientes/edit')
            . view('templates/footer');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        helper('form_validation');
        helper('form');

        if (!$this->validate(
            [
                'nome' => 'required',
                'nome_mae' => 'required',
                'data_nascimento' => 'required',
                'cpf' => 'cpf_is_valid',
                'cns' => 'cns_is_valid',
                'endereco' => 'required',
            ]
        )) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return $this->show($id, session()->setFlashdata('errors', $this->validator->getErrors()));
        }

        $post = $this->validator->getValidated();
        $cpf = preg_replace('/[^0-9]/is', '', $post['cpf']);
        $cns = preg_replace('/[^0-9]/is', '', $post['cns']);
        $CrudModel = new PacientesModel();

        $data = [
            'nome' => $this->request->getVar('nome'),
            'nome_mae' => $this->request->getVar('nome_mae'),
            'data_nascimento'  => $this->request->getVar('data_nascimento'),
            'cpf' => $cpf,
            'cns' => $cns,
            'endereco' => $this->request->getVar('endereco'),
        ];
        $CrudModel->update($id, $data);
        return $this->response->redirect(site_url('/'));
    }

    public function delete($id)
    {

        $model = model(PacientesModel::class);
        $path = $model->find($id);
        $image_path_complete = $_SERVER["DOCUMENT_ROOT"] . $path['image'];
        if (str_contains($image_path_complete, 'img')) {
            unlink($image_path_complete);
        }
        $model->where(['id' => $id])->delete();
        return $this->response->redirect(site_url('/'));
    }
}
