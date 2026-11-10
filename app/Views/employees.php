<section class="card">
    <div class="section-heading">
        <div>
            <h2>Sua equipe</h2>
            <p><?= count($employees) ?> funcionários encontrados</p>
        </div><a class="button" href="cadastro.php">＋ Cadastrar funcionário</a>
    </div>
    <form method="get" class="filters"><label>Pesquisar funcionário<input type="search" name="q"
                placeholder="Nome, e-mail, CPF ou setor" value="<?= e($_GET['q'] ?? '') ?>"></label><button
            class="button secondary">Pesquisar</button><a href="funcionarios.php">Limpar</a></form>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Cargo</th>
                    <th>Setor</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody><?php foreach ($employees as $person): ?>
                    <tr>
                        <td>
                            <div class="person"><img class="avatar" src="<?= e(avatar($person)) ?>"
                                    alt="Foto de <?= e($person['nome_completo']) ?>">
                                <div>
                                    <strong><?= e($person['nome_completo']) ?></strong><small><?= e($person['email']) ?></small>
                                    <span class="badge employee-status <?= $person['status_funcionario'] === 'Inativo' ? 'warning' : 'success' ?>"><?= e($person['status_funcionario']) ?></span>
                                </div>
                            </div>
                        </td>
                        <td><?= e($person['cargo']) ?></td>
                        <td><?= e($person['setor']) ?></td>
                        <td><?= e($person['cpf']) ?></td>
                        <td>
                            <div class="table-actions"><a
                                    href="informacoes.php?id=<?= (int) $person['id_funcionario'] ?>">Ver EPIs</a><a
                                    href="editarfunc.php?id=<?= (int) $person['id_funcionario'] ?>">Editar</a><a
                                    class="danger-text"
                                    href="excluirfunc.php?id=<?= (int) $person['id_funcionario'] ?>">Excluir</a>
                                <?php $inactive = $person['status_funcionario'] === 'Inativo'; ?>
                                <form method="post" action="funcionarios.php"
                                    data-confirm="<?= e(($inactive ? 'Deseja reativar ' : 'Tem certeza de que deseja inativar ') . $person['nome_completo'] . '?') ?>">
                                    <?= csrf() ?>
                                    <input type="hidden" name="id_funcionario" value="<?= (int) $person['id_funcionario'] ?>">
                                    <input type="hidden" name="status" value="<?= $inactive ? 'Ativo' : 'Inativo' ?>">
                                    <button class="employee-status-button" type="submit"><?= $inactive ? 'Reativar' : 'Inativar' ?></button>
                                </form></div>
                        </td>
                    </tr><?php endforeach;
            if (!$employees): ?>
                    <tr>
                        <td colspan="5" class="empty">Nenhum funcionário encontrado.</td>
                    </tr><?php endif ?>
            </tbody>
        </table>
    </div>
</section>
