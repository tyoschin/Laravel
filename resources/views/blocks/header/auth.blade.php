<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-12 col-md-12">
                    <a href="page-index.html" class="brand-wrap">
                        <img class="logo" src="/images/logo.png">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6">
                    <form action="#" class="search-header">
                        <div class="input-group w-100">
                            <select class="custom-select border-right"  name="category_name">
                                <option value="">All type</option><option value="codex">Special</option>
                                <option value="comments">Only best</option>
                                <option value="content">Latest</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-xl-4 col-lg-5 col-md-6">

                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header mr-3">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-user"></i>
                                </div>
                                <small class="text">Выход</small>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div> <!-- widgets-wrap.// -->

                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header mr-3">
                            <a href="{{route('admin.main.index')}}" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-user"></i>
                                </div>
                                <small class="text">Личный кабинет</small>
                            </a>
                        </div>
                    </div> <!-- widgets-wrap.// -->


                </div> <!-- col.// -->



            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->

</header> <!-- section-header.// -->