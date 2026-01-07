

<?php $__env->startSection('title', 'My Results'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Results</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if($results->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo e($result->course->course_name ?? 'N/A'); ?></strong><br>
                                            <small class="text-muted"><?php echo e($result->course->course_code ?? 'N/A'); ?></small>
                                        </td>
                                        <td><strong><?php echo e($result->marks ?? 'N/A'); ?></strong></td>
                                        <td>
                                            <?php
                                                $marks = $result->marks ?? 0;
                                                if ($marks >= 90) $grade = 'A+';
                                                elseif ($marks >= 80) $grade = 'A';
                                                elseif ($marks >= 70) $grade = 'B';
                                                elseif ($marks >= 60) $grade = 'C';
                                                elseif ($marks >= 50) $grade = 'D';
                                                else $grade = 'F';
                                            ?>
                                            <span class="badge bg-<?php echo e($marks >= 50 ? 'success' : 'danger'); ?>"><?php echo e($grade); ?></span>
                                        </td>
                                        <td><?php echo e($result->remarks ?? 'N/A'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <p class="mb-0">No results available yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/student/results/index.blade.php ENDPATH**/ ?>