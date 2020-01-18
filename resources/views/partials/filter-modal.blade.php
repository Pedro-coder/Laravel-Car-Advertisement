<!-- Large modal -->
<div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-modal">
        <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-sliders-h fa-1x" style="color: white;background-color: green"></i> Filter</h4>
            <button type="button" class="close button-close-modal" data-dismiss="modal">&times;</button>
        </div>
      <div class="modal-body mt-2 mb-4">
        <form id="filter-form">
          <div class="container">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control" id="search_input" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-success rounded-0" type="button" id="button-addon2">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row with-border-top">
                <div class="col">
                    <div class="row">
                        <div class="col-md-5" style="padding-right: 0">
                            <div class="form-group" id="">
                                <select id="postFor" class="form-control" >
                                    <option value="0" selected>Type</option>
                                    <option value="bids">Bids</option>
                                    <option value="posts" >Blog</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group" id="categories">
                                <select id="categories" class="form-control">
                                    <option selected>Categories</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ml-2">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control" id="filter_budget_min" placeholder="$ Min">
                        <input type="text" class="form-control ml-2" id="filter_budget_max" placeholder="$ Max">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group d-flex">
                        <label class="mt-2 mr-2" for="filter_category"><strong>Sort:</strong></label>
                        <select class="form-control" id="filter_category"
                                name="filter_category" value="{{ old('filter_category') }}" required autofocus>
                            <option value="newest">Newest</option>
                            <option value="oldest">Older</option>
                            <option value="high">High-Low</option>
                            <option value="low">Low-High</option>
                        </select>
                    </div>
                </div>
            </div>
              <div class="form-row">
                  <div class="col">
                      <div class="input-group">
                          <input type="text" class="form-control" id="filter_within_miles" placeholder="Within miles">
                          <div class="input-group-prepend">
                      <span class="input-group-text" id="filter_within_miles">
                          miles
                      </span>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <div class="input-group">
                              <input type="text" class="form-control" id="filter_user_location" placeholder="User Location">
                              <div class="input-group-prepend">
                      <span class="input-group-text" id="filter_user_location">
                          <i class="fas fa-map-marker-alt"></i>
                      </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="form-row with-border-bottom">
                  <div class="col">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group" id="myPost">
                                  <div class="form-check mt-1 pt-1">
                                      <input class="form-check-input" type="checkbox" id="myPostinp" name="myPost">
                                      <label class="form-check-label" for="myPost" id="myPost">
                                          My Post
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-8">
                              <div class="form-group" id="postBy">
                                  <input type="text" class="form-control" id="postByinp" placeholder="Post By">
                                  <table class="table table-bordered table-hover text-success user-search-table">
                                      <tbody id="postBytbod">
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="row">
                          <div class="col-md-8">
                              <div class="form-group" >
                                  <select id="status" class="form-control hidden" style="visibility: hidden">
                                      <option selected>Status</option>
                                      <option>...</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group" id="online-checkbox">
                                  <div class="form-check mt-1 pt-1 ml-3" id="online-checkbox">
                                      <input class="form-check-input" type="checkbox" name="online-checkbox-filter">
                                      <label class="form-check-label" for="online-checkbox">
                                          <i class="fas fa-user-check"></i> Online
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                <div class="form-row mt-2">
                    <div class="col">
                            <button class="btn btn-success ml-2 rounded-0 float-right" style="color: black;">
                                Submit
                            </button>
                        <button class="btn btn-warning ml-2 rounded-0 float-right">
                            Clear
                        </button>
                    </div>
                </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@section('extra-JS')

@endsection