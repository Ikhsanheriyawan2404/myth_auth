<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="container my-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Group</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('group/' . $group->id) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="<?= $group->name ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control form-control-sm" value="<?= $group->description ?>">
                        </div>

                        <div class="form-group">
                            <label for="customCheckbox1">Permissions <small class="text-danger"></small></label>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="check_all" type="checkbox" onClick="toggle(this)">
                                <label for="check_all" class="custom-control-label">check semua</label>
                            </div>
                            <?php foreach ($permissions as $permission) : ?>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="<?= $permission->name ?>" name="permission[]" type="checkbox" value="<?= $permission->id ?>" <?= $permission->name == isset($permissionGroup[$permission->id]) ? 'checked' : '' ?>>

                                    <label for="<?= $permission->name ?>" class="custom-control-label"><?= $permission->name ?></label>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary my-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>

<script>

    function toggle(source) {
        checkboxes = document.getElementsByName('permission[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }

</script>

<?= $this->endSection() ?>