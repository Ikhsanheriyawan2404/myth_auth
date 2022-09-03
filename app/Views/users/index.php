<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="container my-3">
    <div class="row">
        <div class="col-md-8">
            <a href="<?= base_url('group/new') ?>" class="btn btn-sm btn-primary">Create</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1; 
                    foreach($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $user->email ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->active == 1 ? '<button class="btn btn-sm btn-success">Active</button>' : 'Nonactive'?></td>
                        <td>
                            <a href="<?= base_url('user/'. $user->id .'/edit') ?>" class="btn btn-sm btn-success">Edit</a>
                            <a href="" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>