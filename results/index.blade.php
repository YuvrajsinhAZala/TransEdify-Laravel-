@extends('layouts.student')

@section('title', 'My Results')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Results</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($results->count() > 0)
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
                                @foreach($results as $result)
                                    <tr>
                                        <td>
                                            <strong>{{ $result->course->course_name ?? 'N/A' }}</strong><br>
                                            <small class="text-muted">{{ $result->course->course_code ?? 'N/A' }}</small>
                                        </td>
                                        <td><strong>{{ $result->marks ?? 'N/A' }}</strong></td>
                                        <td>
                                            @php
                                                $marks = $result->marks ?? 0;
                                                if ($marks >= 90) $grade = 'A+';
                                                elseif ($marks >= 80) $grade = 'A';
                                                elseif ($marks >= 70) $grade = 'B';
                                                elseif ($marks >= 60) $grade = 'C';
                                                elseif ($marks >= 50) $grade = 'D';
                                                else $grade = 'F';
                                            @endphp
                                            <span class="badge bg-{{ $marks >= 50 ? 'success' : 'danger' }}">{{ $grade }}</span>
                                        </td>
                                        <td>{{ $result->remarks ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        <p class="mb-0">No results available yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

