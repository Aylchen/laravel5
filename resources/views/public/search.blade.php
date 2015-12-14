<div class="am-g" style="position: absolute;width: 50%; top: 0;right: 30%;">
    {!! Form::open(['url' => $search_url]) !!}
    <div class="am-u-lg-6">
        <div class="am-input-group">
            {!! Form::text('key', $key, ['class' => 'am-form-field', 'placeholder' => '搜索关键词']) !!}
            <span class="am-input-group-btn">
                <button class="am-btn am-btn-default" type="submit"><span class="am-icon-search"></span> </button>
            </span>
        </div>
    </div>
    {!! Form::close() !!}
</div>