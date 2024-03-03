<?php
$statusdesc = null;
if ($data["PageData"]["RegisterData"]->status == 1)
    $statusdesc = "Approved";
elseif ($data["PageData"]["RegisterData"]->status == 2)
    $statusdesc = "Rejected";
else
    $statusdesc = "Pending";
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0"><?= $data["PageDetails"]["Title"]; ?></h1>
</div>
<div class="row">
    <div class="col-12 col-sm-2 mt-2 mb-2">
        <a href="<?= base_url(); ?>admin/registration/pending" class="text-decoration-none">
            <button class="btn btn-sm btn-block btn-outline-secondary" type="button"><i class="fas fa-fw fa-arrow-alt-circle-left"></i> Back</button>
        </a>
    </div>
    <div class="col-12 col-sm-2 mt-2 mb-2">
        <button class="btn btn-sm btn-block btn-outline-info" type="button" data-toggle="modal" data-target="#viewGID"><i class="fas fa-fw fa-eye"></i> View GID</button>
    </div>
    <div class="col-12 col-sm-2 mt-2 mb-2">
        <button class="btn btn-sm btn-block btn-outline-info" type="button" data-toggle="modal" data-target="#viewSID"><i class="fas fa-fw fa-eye"></i> View SID</button>
    </div>
    <?php
    if ($data["PageData"]["RegisterData"]->status == 0) {
        ?>
        <div class="col-12 col-sm-2 mt-2 mb-2">
            <button class="btn btn-sm btn-block btn-outline-danger" type="button" data-toggle="modal" data-target="#reject"><i class="fas fa-fw fa-user-times"></i> Reject</button>
        </div>
        <div class="col-12 col-sm-2 mt-2 mb-2">
            <button class="btn btn-sm btn-block btn-outline-success" type="button" data-toggle="modal" data-target="#approve"><i class="fas fa-fw fa-user-check"></i> Approve</button>
        </div>
        <?php
    }

    if ($data["PageData"]["RegisterData"]->status != 0) {
        ?>
        <div class="col-12 col-sm-2 mt-2 mb-2">
            <a href="<?= base_url(); ?>admin/registration/resend/<?= $data["PageData"]["RegisterData"]->reference; ?>/<?= $data["PageData"]["RegisterData"]->status == 1 ? 'approve' : 'reject' ?>" class="text-decoration-none">
                <button class="btn btn-sm btn-block btn-outline-warning" type="button" id="ResendButton" onclick="ResendBtn()"><i class="fas fa-fw fa-envelope"></i> Resend Email</button>
            </a>
        </div>
        <?php
    }
    ?>
</div>
<div class="row">
    <div class="col-12 col-sm-6 mt-2 mb-2">
        <label>Status: </label>
        <?= $statusdesc; ?>
    </div>
</div>
<?php
if ($data["PageData"]["RegisterData"]->status == 2) {
    ?>
    <div class="row">
        <div class="col-12 col-sm-6 mt-2 mb-2">
            <span class="text-danger">*</span><label>Rejection Remarks: </label> <br>
            <?= nl2br($data["PageData"]["RegisterData"]->rejectReason); ?>
        </div>
    </div>
    <?php
}
?>
<div class="row">
    <div class="col-12 col-sm-6 mt-2 mb-2">
        <div class="card bg-transparent border-0 h-100 py-2">
            <div class="card-body">
                <h4 class="card-title">Information</h4>
                <hr class="bg-light">
                <div class="row">
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Name:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->name; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Gender:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                    <label><?= $data["PageData"]["RegisterData"]->gender; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Date of Birth:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                    <label><?= date("F d, Y", strtotime($data["PageData"]["RegisterData"]->dob)); ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Mobile Number:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->mobile; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Email Address:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <a href="mailto:<?= $data["PageData"]["RegisterData"]->email; ?>"><?= $data["PageData"]["RegisterData"]->email; ?></a>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Home Address:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->address; ?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 mt-2 mb-2">
        <div class="card bg-transparent border-0 h-100 py-2">
            <div class="card-body">
                <h4 class="card-title">School Information</h4>
                <hr class="bg-light">
                <div class="row">
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Name:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->school; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Address:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->schoolAddres; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Representative:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->schoolRep; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Contact:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->schoolContact; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Email:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                    <a href="mailto:<?= $data["PageData"]["RegisterData"]->SchoolEmail; ?>"><?= $data["PageData"]["RegisterData"]->SchoolEmail; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 mt-2 mb-2">
        <div class="card bg-transparent border-0 h-100 py-2">
            <div class="card-body">
                <h4 class="card-title">Entry</h4>
                <hr class="bg-light">
                <div class="row">
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Story:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->Story; ?></label>
                    </div>
                    <div class="col-12 col-sm-4 mt-2 mb-2">
                        <label>Ingredients:</label>
                    </div>
                    <div class="col-12 col-sm-8 mt-2 mb-2">
                        <label><?= $data["PageData"]["RegisterData"]->Ingredients; ?></label>
                    </div>
                    <div class="col-12 mt-2 mb-2">
                        <label>Entry:</label>
                    </div>
                    <div class="col-12 col-sm-2 mt-2 mb-2">
                        <input type="text" class="d-none" value="<?= $data["PageData"]["RegisterData"]->Link; ?>" id="urlLink">
                        <button class="btn btn-sm btn-block btn-primary" type="button" onclick="CopyLink()">Copy Link</button>
                    </div>
                    <div class="col-12 mt-2 mb-2">
                        <div class="embed-responsive embed-responsive-21by9">
                            <?php
                            $fbUrl = array("facebok", "fb");
                            if (str_contains($data["PageData"]["RegisterData"]->Link, "facebook") || str_contains($data["PageData"]["RegisterData"]->Link, "fb")) {
                                ?>
                                <iframe class="embed-responsive-item" src="https://www.facebook.com/plugins/video.php?href=<?= urlencode($data["PageData"]["RegisterData"]->Link); ?>&show_text=false&width=267&t=0" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                                <?php
                            } elseif (str_contains($data["PageData"]["RegisterData"]->Link, "youtube")) {
                                $extractUrl = parse_url($data["PageData"]["RegisterData"]->Link);
                                parse_str($extractUrl['query'], $query);
                                ?>
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $query['v']; ?>?rel=0" allowfullscreen></iframe>
                                <?php
                            } elseif (str_contains($data["PageData"]["RegisterData"]->Link, "tiktok")) {
                                $extractUrl = explode('/', $data["PageData"]["RegisterData"]->Link);
                                ?>
                                <iframe class="embed-responsive-item" src="https://www.tiktok.com/embed/v2/<?= $extractUrl[5]; ?>" allowfullscreen></iframe>
                                <?php
                            } elseif (str_contains($data["PageData"]["RegisterData"]->Link, "instagram")) {
                                ?>
                                <iframe class="embed-responsive-item" src="<?= str_replace("/?hl=en", '', $data["PageData"]["RegisterData"]->Link); ?>/embed" allowfullscreen></iframe>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated--grow-in" id="viewGID" tabindex="-1" aria-labelledby="viewGIDModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                        <h5 class="m-0">Government ID</h5>
                    </div>
                    <div class="col-12 mt-2 mb-3">
                        <img class="img-fluid" src="<?= $data["PageData"]["RegisterData"]->gid; ?>" alt="<?= $data["PageData"]["RegisterData"]->reference; ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-3 mx-auto mt-3 mb-3">
                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-danger"><i class="fas fa-fw fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated--grow-in" id="viewSID" tabindex="-1" aria-labelledby="viewSIDModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                        <h5 class="m-0">School ID / Proof of Enrollment</h5>
                    </div>
                    <div class="col-12 mt-2 mb-3">
                        <img class="img-fluid" src="<?= $data["PageData"]["RegisterData"]->sid; ?>" alt="<?= $data["PageData"]["RegisterData"]->reference; ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-3 mx-auto mt-3 mb-3">
                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-danger"><i class="fas fa-fw fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated--grow-in" id="reject" tabindex="-1" aria-labelledby="rejectModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <?= form_open("AdminRegistration/Reject"); ?>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                            <h5 class="m-0">Reject Registrant - <?= $data["PageData"]["RegisterData"]->reference; ?></h5>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $data["PageData"]["RegisterData"]->reference; ?>" name="Reference">
                    <div class="form-row">
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Reason</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="Invalid Government ID" id="invGID" name="Reason[]">
                                <label class="custom-control-label" for="invGID">Invalid Government ID</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="invSID" value="Invalid School ID / Proof of Enrollment" name="Reason[]">
                                <label class="custom-control-label" for="invSID">Invalid School ID / Proof of Enrollment</label>
                                
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="infTally" value="Information not tally" name="Reason[]">
                                <label class="custom-control-label" for="infTally">Information not tally</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="ageElig" value="Age ineligibility" name="Reason[]">
                                <label class="custom-control-label" for="ageElig">Age ineligibility</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="entryCon" name="Reason[]" value="Entry concern">
                                <label class="custom-control-label" for="entryCon">Entry concern</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="invLink" name="Reason[]" value="Invalid link">
                                <label class="custom-control-label" for="invLink">Invalid link</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="noCockStory" name="Reason[]" value="No cocktail story">
                                <label class="custom-control-label" for="noCockStory">No cocktail story</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Others" class="custom-control-input" id="others" onclick="Others()" value="Others" name="Reason[]">
                                <label class="custom-control-label" for="others">Others</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group d-none" id="specifyReasonContainer">
                            <label class="small font-weight-bold">Specify</label>
                            <textarea name="specifyReason" id="specifyInput" rows="5" class="form-control form-control-sm custom-input"><?= set_value("specifyReason"); ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Submit</button>
                        </div>
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal animated--grow-in" id="approve" tabindex="-1" aria-labelledby="approveModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <?= form_open("AdminRegistration/Approve"); ?>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                            <h5 class="m-0">Approve Registrant - <?= $data["PageData"]["RegisterData"]->reference; ?></h5>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $data["PageData"]["RegisterData"]->reference; ?>" name="Reference">
                    <div class="form-row">
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Submit</button>
                        </div>
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script typ="javascript">
    function CopyLink() {
        var copyText = document.getElementById("urlLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        
        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
        console.log(copyText.value);
    }

    function ResendBtn() {
        document.getElementById("ResendButton").disabled = true;
    }

    function Others() {
        var specifyContainer    = document.getElementById("specifyReasonContainer");
        var specifyInput        = document.getElementById("specifyInput");
        if (document.getElementById('others').checked) {
            specifyContainer.classList.remove("d-none");
            specifyInput.required = true;
            /*
            document.getElementById("invGID").checked   = false;
            document.getElementById("invSID").checked   = false;
            document.getElementById("infTally").checked = false;
            document.getElementById("ageElig").checked  = false;
            document.getElementById("entryCon").checked = false;

            document.getElementById("invGID").disabled      = true;
            document.getElementById("invSID").disabled      = true;
            document.getElementById("infTally").disabled    = true;
            document.getElementById("ageElig").disabled     = true;
            document.getElementById("entryCon").disabled    = true;*/
        } else {
            specifyContainer.classList.add("d-none");
            specifyInput.required = false;

            document.getElementById("invGID").disabled      = false;
            document.getElementById("invSID").disabled      = false;
            document.getElementById("infTally").disabled    = false;
            document.getElementById("ageElig").disabled     = false;
            document.getElementById("entryCon").disabled    = false;
        }
    }
</script>