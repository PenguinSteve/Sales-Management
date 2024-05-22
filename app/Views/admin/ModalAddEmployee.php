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
                <form class="form form-horizontal">
                    <div class="form-body">
                        <div class="row ml-3">
                            <div class="col-md-3">
                                <label>Name</label>
                            </div>
                            <div class="col-md-8 mb-2">
                                <input type="text" class="form-control" id="name" placeholder="Enter name">
                            </div>

                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <div><a href="product/addProduct" class="btn btn-primary mr-4">Save</a></div>
                <button type="button" class="btn btn-success ml-1">Save</button>
            </div>
        </div>
    </div>
</div>