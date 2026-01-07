

<?php $__env->startSection('title', 'My Fees'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Fees</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if($fees->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($fee->created_at->format('M d, Y')); ?></td>
                                        <td><?php echo e($fee->description ?? 'Fee Payment'); ?></td>
                                        <td><strong>$<?php echo e(number_format($fee->amount, 2)); ?></strong></td>
                                        <td>
                                            <?php if($fee->status === 'paid'): ?>
                                                <span class="badge bg-success">Paid</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Unpaid</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <?php
                            $totalFees = $fees->sum('amount');
                            $paidFees = $fees->where('status', 'paid')->sum('amount');
                            $unpaidFees = $fees->where('status', 'unpaid')->sum('amount');
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Total Fees</h6>
                                        <h4>$<?php echo e(number_format($totalFees, 2)); ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <h6>Paid</h6>
                                        <h4>$<?php echo e(number_format($paidFees, 2)); ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning">
                                    <div class="card-body">
                                        <h6>Unpaid</h6>
                                        <h4>$<?php echo e(number_format($unpaidFees, 2)); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <p class="mb-0">No fee records found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/student/fees/index.blade.php ENDPATH**/ ?>