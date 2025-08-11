<h2>Ordem de Serviço</h2>
<a href="<?=base_url('os/adicionar')?>">Nova OS</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Equipamento</th>
        <th>Descrição Produto</th>
        <th>Ações</th>
    </tr>
    <?php if (!empty($oss)): foreach ($oss as $os): ?>
    <tr>
        <td><?= $os->id ?></td>
        <td><?= $os->cliente_id ?></td>
        <td><?= $os->equipamento_id ?></td>
        <td><?= $os->descricaoProduto ?></td>
        <td>
            <a href="<?=base_url('os/editar/'.$os->id)?>">Editar</a> |
            <a href="<?=base_url('os/detalhes/'.$os->id)?>">Detalhes</a>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td colspan="5">Nenhuma OS cadastrada.</td></tr>
    <?php endif; ?>
</table>
