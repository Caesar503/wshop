<div class="lrList">
        <select class="che" name="area" id="area">
        <option value="0">--请选择--</option>
         @foreach($res as $v)
         <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
        </select>
</div>