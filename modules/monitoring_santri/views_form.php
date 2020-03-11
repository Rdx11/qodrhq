<h1>Monitoring Santri</h1>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <form action="admin.php?page=qodr-monitoring-santri" method="POST">
            <div class="form-group">
            <label for="exampleFormControlInput1">Tgl</label>
            <input type="date" class="form-control" name="tgl" id="exampleFormControlInput1" value="'.date('m/d/y').'">
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput2">Santri</label>
            <select class="form-control" id="exampleFormControlSelect1" name="uid">
            <?php
            foreach ($santri as $key) {
                echo '<option value='.$key['uid'].'>'.$key['uid'].'</option>';    
            }
            ?>
                </select>
            </div>              
            <div class="form-group">
            <label for="exampleFormControlInput1">IT</label>
            <input type="date" class="form-control" name="it_deadline" id="exampleFormControlInput1">
            <textarea class="form-control" name="it_keterangan"></textarea>
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput2">Tahsin</label>
            <input type="text" class="form-control" name="tahsin_nilai"  placeholder="Nilai">
            <textarea class="form-control" name="tahsin_keterangan" placeholder="Keterangan"></textarea>
            </div>                             
            <div class="form-group">
            <label for="exampleFormControlSelect1">Tahfidz</label>
            <select class="form-control" id="exampleFormControlSelect1" name="tahsin">
            
            </select>
            <textarea class="form-control"></textarea>                            
            </div>
    </div>  
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
            <label for="exampleFormControlInput1">Duolingo</label>
            <input type="text" class="form-control" name="duolingo" id="exampleFormControlInput1" value="">
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput1">Deadline</label>
            <input type="text" class="form-control" name="deadline" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput1">Integrity</label>
            <textarea class="form-control" name="integrity" id="exampleFormControlInput1"></textarea>
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput1">Reward</label>
            <textarea class="form-control" name="reward" id="exampleFormControlInput1"></textarea>
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput1">Punishment</label>
            <textarea class="form-control" name="punishment" id="exampleFormControlInput1"></textarea>
            </div>                          
        
            <button type="submit" class="btn btn-success">Submit</button>

        </form>
        </div>
</div>