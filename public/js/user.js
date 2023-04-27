
function showErrorMessage(error, message) {
    if (error) {
        $("#" + message + "Error").show();
        $("#" + message + "Error").html(error);
        $("#" + message).addClass("is-invalid");
    }
}
function hideErrorMessage(showErrors) {
    for (let i = 0; i < showErrors.length; i++) {
        $("#" + showErrors[i] + "Error").hide();
        $("#" + showErrors[i]).removeClass("is-invalid");
    }
}


// create user
$("#createUserForm").submit(function (e) {
    e.preventDefault();
    let formData = new FormData($("#createUserForm")[0]);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/user',
        type: 'POST',
        data: formData,
        beforeSend: function () {
            $.LoadingOverlay('show');
        },
        contentType: false,
        processData: false,
        success: function (response) {
            let showErrors = [
                "name",
                "email",
            ];
            hideErrorMessage(showErrors);
            let tableRow = `<tr>
                            <th> ${response.data.name} </th>
                            <th> ${response.data.email} </th>
                            <th>
                                <span class="badge badge-warning">Assign</span>
                            </th>
                            <th>
                                <span class="badge badge-danger">Disabled</span>
                            </th>
                            <th >
                                <div class="float-right">
                                    <a href="javascript:void(0)" onclick="deleteUser(${response.data.id})"><i class="fas fa-trash ml-2 mr-2" style="color: #dc3545"></i></a>
                                    <a href="javascript:void(0)" onclick="changeUserStatus(${response.data.id})"><i class="fas fa-ban ml-2 mr-2" style="color: #ffc107"></i></a>
                                </div>
                            </th>

                        </tr>`;
            $('#user-table').append(tableRow);
            $('#createUserModal').modal('toggle');
            $.LoadingOverlay('hide');
            $("#createUserForm")[0].reset();
            toastr.success('User is Created!');
        },
        error: function (respnose) {
            if(respnose.status == 400){
                let showErrors = [
                    "name",
                    "email",
                ];
                hideErrorMessage(showErrors);
                for (let [key, value] of Object.entries(respnose.responseJSON.errors)) {
                    showErrorMessage(value[0], key);
                }
            }else{
                toastr.error(respnose.responseJSON.errors);
            }
            $.LoadingOverlay('hide');
        }
    });
});


let deleteUserId;
function deleteUser(id) {
    deleteUserId = id;
    $('#deleteUserModal').modal('toggle');
}

// delete user
$("#deleteUserForm").submit(function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: `/user/${deleteUserId}` ,
        type: 'delete',
        beforeSend: function () {
            $.LoadingOverlay('show');
        },
        contentType: false,
        processData: false,
        success: function (response) {
            $('#userRow' + deleteUserId).remove();
            toastr.success(response.message);
        },
        error: function (respnose) {
            toastr.error(respnose.responseJSON.errors);
        },
        complete: function (){
            $('#deleteUserModal').modal('toggle');
            $.LoadingOverlay('hide');
        }
    });
});

let UserStatusId;
function changeUserStatus(id) {
    UserStatusId = id;
    $('#blockUserModal').modal('toggle');
}
// Block user
$("#blockUserForm").submit(function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: `/user/status/${UserStatusId}` ,
        type: 'delete',
        beforeSend: function () {
            $.LoadingOverlay('show');
        },
        contentType: false,
        processData: false,
        success: function (response) {
            toastr.success(response.message);
            location.reload();
        },
        error: function (respnose) {
            toastr.error(respnose.responseJSON.errors);
        },
        complete: function (){
            $('#blockUserModal').modal('toggle');
            $.LoadingOverlay('hide');
        }
    });
});
