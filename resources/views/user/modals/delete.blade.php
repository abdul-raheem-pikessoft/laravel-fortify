
{{-- Delete User Modal --}}
<div class="modal fade" id="deleteUserModal">
    <div class="modal-dialog modal-dialog-centered modal-md card-middle">
        <div class="modal-content">
            <div class="modal-header pl-3 pt-3 pb-2" >
                <p class="modal-title notification-detail-text"><b>Delete Notification</b></p>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col notification-detail-textt">
                        <small>Are You Sure You Want To Delete This User</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between ">
                <button type="button" class="btn btn-info btn-xs" data-bs-dismiss="modal">No</button>
                <form id="deleteUserForm">
                    <input id="deleteUserButton" type="submit" id class="btn btn-xs btn-danger" value="Confirm">
                </form>
            </div>
        </div>
    </div>
</div>

