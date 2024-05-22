<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="addUpdate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--header-->
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel">Add a new Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--enter information-->
            <div class="modal-body">
                <form id="formAdd" class="form form-horizontal" method="POST" action="admin/createUser">
                    <div class="form-body">
                        <div class="row ml-3">
                            <div class="col-md-3">
                                <label>Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                            </div>

                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-3" name="email" id="email" placeholder="Enter email">
                            </div>
                            <small style="color: red; display: none">Name cannot be empty!</small>
                        </div>
                    </div>
                </form>
            </div>

            <!--footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="saveAdd" class="ml-1 btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>