<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Os_model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
    }

    // Listagem de OSs
    public function index()
    {
        $data['oss'] = $this->Os_model->getAll();
        $this->load->view('os/index', $data);
    }

    // Adicionar nova OS
    public function adicionar()
    {
        $this->load->model('Clientes_model');
        $this->load->model('Equipamentos_model');

        if ($this->input->method() == 'post') {
            $dados = [
                'cliente_id'      => $this->input->post('cliente_id'),
                'equipamento_id'  => $this->input->post('equipamento_id'),
                'descricaoProduto'=> $this->input->post('descricaoProduto'),
                'defeito'         => $this->input->post('defeito'),
                'observacoes'     => $this->input->post('observacoes'),
            ];
            $this->Os_model->add($dados);
            redirect('os');
        } else {
            $data['clientes'] = $this->Clientes_model->getAll();
            $data['equipamentos_cliente'] = [];
            $this->load->view('os/adicionarOs', $data);
        }
    }

    // Editar OS
    public function editar($id)
    {
        $this->load->model('Clientes_model');
        $this->load->model('Equipamentos_model');
        $os = $this->Os_model->getById($id);

        if ($this->input->method() == 'post') {
            $dados = [
                'cliente_id'      => $this->input->post('cliente_id'),
                'equipamento_id'  => $this->input->post('equipamento_id'),
                'descricaoProduto'=> $this->input->post('descricaoProduto'),
                'defeito'         => $this->input->post('defeito'),
                'observacoes'     => $this->input->post('observacoes'),
            ];
            $this->Os_model->update($id, $dados);
            redirect('os');
        } else {
            $data['os'] = $os;
            $data['clientes'] = $this->Clientes_model->getAll();
            $data['equipamentos_cliente'] = $this->Equipamentos_model->getByUsuario($os->cliente_id);
            $this->load->view('os/editarOs', $data);
        }
    }

    // Detalhes da OS
    public function detalhes($id)
    {
        $this->load->model('Clientes_model');
        $this->load->model('Equipamentos_model');
        $os = $this->Os_model->getById($id);
        $cliente = $this->Clientes_model->getById($os->cliente_id);
        $equipamento = $os->equipamento_id ? $this->Equipamentos_model->getById($os->equipamento_id) : null;

        $data = compact('os', 'cliente', 'equipamento');
        $this->load->view('os/detalhesOs', $data);
    }

    // ENDPOINT AJAX: retorna equipamentos do cliente via JSON
    public function getEquipamentosCliente($clienteId)
    {
        $this->load->model('Equipamentos_model');
        $eqs = $this->Equipamentos_model->getByUsuario($clienteId);
        echo json_encode($eqs);
    }
}