

<?php $__env->startSection('title', 'Manage Attendance'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Attendance</h2>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Mark Attendance</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('admin.attendance.index')); ?>" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Select Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">-- Select Course --</option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($course->id); ?>" <?php echo e($selectedCourseId == $course->id ? 'selected' : ''); ?>>
                                        <?php echo e($course->course_code); ?> - <?php echo e($course->course_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo e($selectedDate); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="submit" name="view" value="1" class="btn btn-info">View Attendance</button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php if($selectedCourseId && $students->count() > 0): ?>
                <form method="POST" action="<?php echo e(route('admin.attendance.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="course_id" value="<?php echo e($selectedCourseId); ?>">
                    <input type="hidden" name="date" value="<?php echo e($selectedDate); ?>">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student->id); ?></td>
                                        <td><?php echo e($student->name); ?></td>
                                        <td><?php echo e($student->username); ?></td>
                                        <td>
                                            <select name="attendance[<?php echo e($student->id); ?>]" class="form-select form-select-sm">
                                                <option value="present">Present</option>
                                                <option value="absent">Absent</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save Attendance</button>
                </form>
                <?php elseif($viewAttendance && $attendanceRecords->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $attendanceRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($record->student->name); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($record->status == 'present' ? 'success' : 'danger'); ?>">
                                                <?php echo e(ucfirst($record->status)); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($record->date); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php elseif($selectedCourseId): ?>
                    <div class="alert alert-warning">No students enrolled in this course.</div>
                <?php else: ?>
                    <div class="alert alert-info">Please select a course to mark attendance.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-education-erp\resources\views/admin/attendance/index.blade.php ENDPATH**/ ?>