<?php require_once "./template/header.php" ?>
<header class="container">
    <h1>Annonces</h1>
</head>


<div class="container">
    
    <div class="row">
        <div class="col-md-3 border-right">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-9 ">
            <ul class="list-group list-group-flush">
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="data:image/jpeg;base64,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">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>BMW M3 E30</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">80 0000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="https://cdn.vroom.be/media/public/articles/ADVICE/gallery/22906/96980-7287dba3-4eb8-4d04-98f5-57ac184c5913.jpg">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>Ferrari F40</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">1 350 0000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="https://img4.autodeclics.com/photos/13/383745/hd-jaguar-type-e-by-electrogenic---les-photos-de-l’icône-électrifiée.jpg">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>Jaguar Type E</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">175 0000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="https://cdn.motor1.com/images/mgl/1ALLW/s3/2019-mercedes-amg-g63-edition-1.jpg">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>Mercedes G 63 AMG</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">109 000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="data:image/jpeg;base64,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">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>BMW M3 E30</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">80 0000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="https://cdn.vroom.be/media/public/articles/ADVICE/gallery/22906/96980-7287dba3-4eb8-4d04-98f5-57ac184c5913.jpg">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>Ferrari F40</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">1 350 0000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="https://img4.autodeclics.com/photos/13/383745/hd-jaguar-type-e-by-electrogenic---les-photos-de-l’icône-électrifiée.jpg">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>Jaguar Type E</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">175 0000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item list-group-item">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img class="img-fluid rounded img-responsive" src="https://cdn.motor1.com/images/mgl/1ALLW/s3/2019-mercedes-amg-g63-edition-1.jpg">
                        </div>
                        <div class="col">
                            <div class="col">
                                <div class="row">
                                    <h1>Mercedes G 63 AMG</h1>
                                </div>
                                <div class="row">
                                    <p class="text-warning">109 000 €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
</div>
<style>
    .item:hover{
        cursor: pointer;
        background-color: #f1eceb ;
    }
</style>
<?php require_once "./template/footer.php" ?>