
<div class="col-sm-3 page-sidebar">
    <aside>
        <div class="inner-box">
            <div class="user-panel-sidebar">
                <div class="collapse-box">
                    <h5 class="collapse-title no-border"> My Classified <a href="#MyClassified" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                    <div class="panel-collapse collapse in" id="MyClassified">
                        <ul class="acc-list">
                            <li><a class={{(Request::is('profile')==1)?"active":"inactive"}} href="{{url('/profile')}}"><i class="icon-home"></i> Personal Home </a></li>
							<li><a class={{(Request::is('password_update')==1)?"active":"inactive"}} href="{{url('/password_update')}}"><i class="icon-cog"></i> Settings </a></li>
                        </ul>
                    </div>
                </div>

                <div class="collapse-box">
                    <h5 class="collapse-title"> My Ads <a href="#MyAds" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                    <div class="panel-collapse collapse in" id="MyAds">
                        <ul class="acc-list">
                            <li><a class={{(Request::is('myads')==1)?"active":"inactive"}} href="{{url('/myads')}}"><i class="icon-docs"></i> active ads <span class="badge">{{$user->activeProduct->count()}}</span> </a></li>
                            <li><a class={{(Request::is('favourite-ads')==1)?"active":"inactive"}} href="{{url('/favourite-ads')}}"><i class="icon-heart"></i> Favourite ads <span class="badge">{{$user->favourites->count()}}</span> </a></li>
                            <li><a class={{(Request::is('saved-search')==1)?"active":"inactive"}} href="{{url('/saved-search')}}"><i class="icon-star-circled"></i> Saved search <span class="badge">{{$user->saveAllSearches->count()}}</span> </a></li>
                            <li><a class={{(Request::is('archived-ads')==1)?"active":"inactive"}} href="{{url('/archived-ads')}}"><i class="icon-folder-close"></i> Archived ads <span class="badge">{{$user->ArchivedProduct->count()}}</span></a></li>
                            <li><a class={{(Request::is('pending-approval-ads')==1)?"active":"inactive"}} href="{{url('/pending-approval-ads')}}"><i class="icon-hourglass"></i> Pending ads <span class="badge">{{$user->pendingProduct->count()}}</span></a></li>
                            <li><a class={{(Request::is('messages')==1)?"active":"inactive"}} href="{{url('/messages')}}"><i class="glyphicon glyphicon-envelope"></i> Messages <span class="badge">{{$user->new_messages->count()}}</span></a></li>
                            <li><a class={{(Request::is('ad-abuses')==1)?"active":"inactive"}} href="{{url('/ad-abuses')}}"><i class="glyphicon glyphicon-thumbs-down"></i> Ad Abuses <span class="badge">{{$user->productAbuse()->count()}}</span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="collapse-box">
                    <h5 class="collapse-title"> Terminate Account <a href="#TerminateAccount" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                    <div class="panel-collapse collapse in" id="TerminateAccount">
                        <ul class="acc-list">
                            <li><a class={{(Request::is('account-close')==1)?"active":"inactive"}} href="{{url('/account-close')}}"><i class="icon-cancel-circled "></i> Close account </a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </aside>
</div>
