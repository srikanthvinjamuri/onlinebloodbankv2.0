<div id="something" style="height: 460px">
    <h2 style="text-align: center"><b>Login</b></h2> 
<div class="col-md-4 col-md-offset-4 jumbotron" ng-controller="forgotController" style="background-color: #e6e6e6">
    
    <form name="form"   ng-submit="submit()" >
        <div class="form-group"  style="padding-left: 0px">
            <label for="current">Current userid<span style="color: red"> *</span></label>
            <input type="text" name="current" id="username" class="form-control" ng-model="current" required />
                </div>
        <div class="form-group">
            <label for="Newpassword">New Password<span style="color: red"> *</span></label>
            <input type="password" name="password" id="password" class="form-control" ng-model="password" required />
                </div>
        <div class="form-actions">
            <table>
                <tr>
                    <td><div><button type="submit"  class="btn btn-primary">Update password</button></div></td>
       
            
                     

           </tr>
            </table>
<!--              <span>{{responseMessage}}</span>-->
        </div>
    </form>
</div>
</div>
