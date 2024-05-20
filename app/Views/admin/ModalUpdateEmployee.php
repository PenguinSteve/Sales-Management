<div class="modal fade" id="updateEmployee" tabindex="-1" role="dialog" aria-labelledby="addUpdate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--header-->
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel">Information of an Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--enter information-->
            <div class="modal-body">
                <form class="form form-horizontal">
                    <div class="form-body">
                        <div class="row ml-3">
                            <div class="col-md-3">
                                <label>ID</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="text" class="form-control" id="id" disabled>
                            </div>

                            <div class="col-md-3">
                                <label>Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="text" class="form-control" id="name">
                            </div>

                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="text" class="form-control" id="email">
                            </div>

                            <div class="d-flex">
                                <div class="col-md-3">
                                    <label>Lock account</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-primary ml-2" checked name="customCheck" id="customColorCheck1">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <!--footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success ml-1">Save</button>
            </div>
        </div>
    </div>
</div>
