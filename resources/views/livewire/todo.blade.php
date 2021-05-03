<section>

    <div class="card">
        <div class="card-body">
            <h4><b>Todo List</b></h4>
            <br>
            <button class="btn btn-success mb-4"  wire:click="create">Add Todo</button>
            <table class="table table-borderless table-hover" >
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col" width="40px">&nbsp;</th>
                        <th scope="col" width="25px">#</th>
                        <th scope="col">Title</th>
                        <th scope="col" width="200px">Status</th>
                        <th scope="col" width="200px">Created at</th>
                        <th scope="col" width="200px">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($todos as $todo)
                        <tr class="@if($todo->is_completed) text-success @else text-danger @endif">
                            <td style="vertical-align: middle;">
                                <button class="btn btn-sm btn-outline-dark p-0 @if($todo->is_completed) active @endif" style="@unless($todo->is_completed) background: #fff !important; color:#636f83; @endunless width:25px; height: 25px;" wire:click="toogleisCompleted({{ $todo->id }})">
                                    <i class="las la-check m-0 mt-1" style="font-size: .8rem"></i>
                                </button>
                            </td>
                            <th style="vertical-align: middle;">{{ $loop->iteration }}</th>
                            <th style="vertical-align: middle;">{{ $todo->title }}</th>
                            <th style="vertical-align: middle;">
                                @if($todo->is_completed)
                                    Completed
                                @else
                                    Pending
                                @endif
                            </th>
                            <th style="vertical-align: middle;">{{ $todo->created_at->format('F d, Y h:i A') }}</th>
                            <th style="vertical-align: middle;">
                                <button class="btn btn-sm btn-outline-dark p-0" style="width:35px; height: 35px; border-radius: 50%;" wire:click="edit({{ $todo->id }})">
                                    <i class="las la-pen m-0 mr-1 mt-1" style="font-size: 1.1rem"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-dark p-0 ml-2" style="width:35px; height: 35px; border-radius: 50%;" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete({{ $todo->id }})">
                                    <i class="las la-trash-alt m-0 mr-2 mt-1" style="font-size: 1.1rem"></i>
                                </button>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-muted text-center">
                                <i>No todo was created yet</i>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="todoActionModal" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="todoActionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="todoActionModalLabel">{{ $this->todo_action_type }} Todo</h5>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="@if($this->todo_action_type == "Create") store @else update @endif">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control @error('todo_action_title') is-invalid @enderror"  wire:model.defer="todo_action_title">
                        @error('todo_action_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control @error('todo_action_description') is-invalid @enderror" wire:model.defer="todo_action_description" rows="5"></textarea>
                        @error('todo_action_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="button" class="btn btn-danger" wire:click="resetAll">Close</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>


      @section('scripts')
        <script>
            window.addEventListener('toggleModalTodo', function(){
                $('#todoActionModal').modal('toggle');
            });
        </script>
      @endsection
</section>
