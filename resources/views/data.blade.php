    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="all ml-4" type="checkbox" >Show All
                    </div>
                </div>
                <form id="taskForm" method="post" action="javascript:void(0)">

                        <div class="row card-body">

                            <div class="col-sm-8">
                                <span class="backenderror"></span>

                                <input type="text" class="form-control control-group todo-list-input" name="Task" placeholder="What do you need to do today?">
                          </div>
                            <div class="col-sm-4">
                                <button type="submit" class="add btn btn-primary font-weight-bold todo-list-add-btn" id="AddList">Add</button> 

                            </div>
                        </div>
                </form>

                 <div class="row card-body" >
                    <div class="col-sm-12">
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse todo-list">
                               @foreach($tasks as $task) 
                            <li id="{{$task->id}}" @if($task->status==1)class="completed"@endif>
                             <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"  value="{{$task->id}}" @if($task->status==1)checked="" @endif> {{$task->task}} <i class="input-helper"></i></label> </div> <button  class="btn btn-danger delete ml-4" value="{{$task->id}}"><i class="fa fa-trash" aria-hidden="true" onclick=""></i></button>

                                </li>
                                
                                @endforeach
                               
                            </ul>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>