<?php require('partials/header.php'); ?>
<?php require('partials/errors.php'); ?>
<div class="container top-item">
    <h1>Users</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th style="width: 36px;"></th>
            <th style="width: 36px;"></th>
            <th style="width: 36px;"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $value) { ?>
            <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->firstname; ?></td>
                <td><?php echo $value->lastname; ?></td>
                <td><?php echo $value->username; ?></td>
                <td>
                    <a href="/iMAG/view?id=<?php echo $value->id; ?>" class="btn btn-default" role="button"
                       data-toggle="modal"><i
                                class="fa fa-street-view"></i> View</a>
                </td>
                <td>
                    <?php
                    if ($user->email === $value->email || $user->admin != 0) { ?>
                        <a href="/iMAG/edit?id=<?php echo $value->id; ?>" class="btn btn-default">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    if ($user->admin) { ?>
                        <a href="/iMAG/delete?id=<?php echo $value->id; ?>"
                           class="btn btn-default" role="button" data-toggle="modal">
                            <i class="fa fa-remove"></i> Delete
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php require 'partials/pagination.php'; ?>

    <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete Confirmation</h3>
        </div>
        <div class="modal-body">
            <p class="error-text">Are you sure you want to delete the user?</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-danger" data-dismiss="modal">Delete</button>
        </div>
    </div>

</div>
<?php require('partials/footer.php'); ?>

