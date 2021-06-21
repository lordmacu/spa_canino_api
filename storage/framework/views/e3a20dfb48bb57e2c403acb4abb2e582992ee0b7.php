<div class="table-responsive">
    <table class="table" id="banners-table">
        <thead>
            <tr>
                
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                
                <td width="120">
                    <?php echo Form::open(['route' => ['banners.destroy', $banner->id], 'method' => 'delete']); ?>

                    <div class='btn-group'>
                        <a href="<?php echo e(route('banners.show', [$banner->id])); ?>" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('banners.edit', [$banner->id])); ?>" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        <?php echo Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /var/www/html/spa_canino_api/resources/views/banners/table.blade.php ENDPATH**/ ?>