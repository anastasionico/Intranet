@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form"  action="register" method="post">
                        {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="department" class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                <select name='department_id' class="form-control" required>
                                    <option value="0">Not Defined</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->name }} 
                                            | Manager: {{ $department->manager->name }} {{ $department->manager->surname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="personal_manager" class="col-md-4 control-label">Personal Manager</label>
                            <div class="col-md-6">
                                <select name="personal_manager"  class="form-control" required>
                                    <option value="1">Not Defined</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }} {{ $user->surname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="holiday_total" class="col-md-4 control-label">Total days holiday (per year)</label>
                            <div class="col-md-6">
                                <input type="number" name="holiday_total" class="form-control" min="23" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="holiday_taken" class="col-md-4 control-label">Already taken days holiday (current year)</label>
                            <div class="col-md-6">
                                <input type="number" name="holiday_taken" class="form-control" min='0' required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                <select name='role_id' class="form-control" required>
                                    <option value="0">Not Defined</option>
                                    {{-- @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }} 
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="job_level"  class="col-md-4 control-label">Job Level</label>
                            <div class="col-md-6">
                                <input type="number" name="job_level" class="form-control" min="1" value="1">
                                <small>1 entry, 2 senior, 3 manager</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expenses_mileage_rate" class="col-md-4 control-label">Expenses Mileage Rate</label>
                            <div class="col-md-6">
                                <input type="number" name="expenses_mileage_rate" class="form-control" value="20">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
