<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createUserForm">
                <div class="modal-body">
                        @csrf
                        <for name="name"></for>
                        <label for="name" class="m-0"><small class="text-dark mb-0"><b>Name</b></small></label>
                        <div class="mb-1 mt-1 input-group-sm input_field " >
                            <input type="text" id="name" class="form-control" name="name"  autocomplete="name" autofocus placeholder="Name">
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>

                        <for name="email"></for>
                        <label for="email" class="m-0"><small class="text-dark mb-0"><b>Email</b></small></label>
                        <div class="mb-1 mt-1 input-group-sm input_field " >
                            <input type="email" id="email" class="form-control" name="email" autocomplete="email" autofocus placeholder="Email">
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
    `           </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
