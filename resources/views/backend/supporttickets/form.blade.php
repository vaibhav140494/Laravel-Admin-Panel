<div class="box-body">
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        
         {{ Form::label('first_name','User Name', ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
             {{ Form::text('first_name',$supporttickets[0]->first_name, ['class' => 'form-control box-size', 'placeholder' =>'User Name' , 'required' => 'required','readonly'=>'true']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        {{ Form::label('topic','Subject', ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('topic',$supporttickets[0]->topic, ['class' => 'form-control box-size', 'placeholder' =>'Subject' , 'required' => 'required','readonly'=>'true']) }} 
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('oid','Order Id', ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('oid',$supporttickets[0]->oid, ['class' => 'form-control box-size', 'placeholder' =>'Order Id' , 'required' => 'required','readonly'=>'true']) }} 
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('admin_comment','Admin Comment', ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('admin_comment',$supporttickets[0]->admin_comment, ['class' => 'form-control box-size', 'placeholder' =>'Admin Comment' ]) }} 
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('status','Status', ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            <select name="status" id="status" class="form-control box-size">
                <option value="generated" <?php echo ($supporttickets[0]->status == 'generated') ? "selected": " " ;  ?>>generated</option>
                <option value="processed" <?php echo ($supporttickets[0]->status == 'processed') ? "selected": " " ;  ?>>processed</option>
                <option value="removed" <?php echo ($supporttickets[0]->status == 'removed') ? "selected": " " ;  ?>>removed</option>
            </select>
        </div>
    </div>
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
