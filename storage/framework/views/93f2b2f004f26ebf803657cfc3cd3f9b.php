

<?php $__env->startSection('title', 'My Attendance'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Attendance</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if($attendances->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($attendance->date->format('M d, Y')); ?></td>
                                        <td><?php echo e($attendance->course->course_name ?? 'N/A'); ?> (<?php echo e($attendance->course->course_code ?? 'N/A'); ?>)</td>
                                        <td>
                                            <?php if($attendance->status === 'present'): ?>
                                                <span class="badge bg-success">Present</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Absent</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <p class="mb-0">No attendance records found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/student/attendance/index.blade.php ENDPATH**/ ?>