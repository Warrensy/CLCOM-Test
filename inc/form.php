<div class="row mt-5 mb-3">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header text-center">
                <h3 class="mb-0">Registration</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="anrede" class="col-4 col-form-label">Salutation</label>
                                <div class="col-8">
                                    <select id="anrede" name="anrede"  class="form-control here">
                                    <option value="m">Mister</option>
                                    <option value="f">Miss</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">User Name*</label>
                                <div class="col-8">
                                    <input id="username" name="username" placeholder="Username" class="form-control here" required="required" type="text" value="<?= $data['username'] ?? '' ?>" />
                                    <div class="text-muted font-weight-bold p-1">Can not be changed later</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" class="col-4 col-form-label">First Name</label>
                                <div class="col-8">
                                    <input id="firstName" name="firstName" placeholder="First Name" class="form-control here" type="text" value="<?= $data['firstName'] ?? '' ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" class="col-4 col-form-label">Last Name</label>
                                <div class="col-8">
                                    <input id="lastName" name="lastName" placeholder="Last Name" class="form-control here" type="text" value="<?= $data['lastName'] ?? '' ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="email" value="<?= $data['email'] ?? '' ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-4 col-form-label">Password</label>
                                <div class="col-8">
                                    <input id="newpass" name="password" placeholder="*****" class="form-control here" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repeatPassword" class="col-4 col-form-label">Repeat Password</label>
                                <div class="col-8">
                                    <input id="repeatPassword" name="repeatPassword" placeholder="repeatPassword" class="form-control here" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Create Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>