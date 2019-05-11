<div class="prolist">
        @foreach($res as $v)
          <dl>
               <dt><a href="/Jewe/proinfo/{{$v->id}}"><img src="/one/uploads/goods/{{$v->goods_img}}" width="100" height="100" /></a></dt>
               <dd>
                <h3><a href="/Jewe/proinfo">{{$v->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$v->self_price}}</strong> <span>¥{{$v->market_price}}</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>已售：{{$v->sell_num}}</em></div>
               </dd>
               <div class="clearfix"></div>
          </dl>
        @endforeach
</div><!--prolist/-->