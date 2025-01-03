<h2 class="sr-only visually-hidden">MarkDown</h2>

<{if $needpasswd=='1'}>
    <div class="alert alert-danger">
        <form action="page.php" method="post" id="myForm">
            <div class="input-group">
                <div class="input-group-prepend input-group-addon">
                    <span class="input-group-text"><{$smarty.const._MD_TADBOOK3_INPUT_PASSWD}></span>
                </div>
                <input type="text" name="passwd" class="form-control" >
                <div class="input-group-append input-group-btn">
                    <input type="hidden" name="tbsn" value=<{$tbsn|default:''}>>
                    <input type="hidden" name="op" value="check_passwd">
                    <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-disk" aria-hidden="true"></i>  <{$smarty.const._TAD_SUBMIT}>
                    </button>
                </div>
            </div>
        </form>
    </div>
<{else}>
    <div class="row" style="background-image: url('images/relink_bg.gif'); padding: 10px 0px;">
        <div class="col-sm-4 text-left text-start"><{$p|default:''}></div>
        <div class="col-sm-4 text-center">
            <select onChange="window.location.href='markdown.php?tbdsn='+this.value" class="form-control form-select" title="Select Document">
            <{$doc_select|default:''}>
            </select>
        </div>
        <div class="col-sm-4 text-right text-end"><{$n|default:''}></div>
    </div>

    <textarea name="markdown" id="markdown" title="markdown code" rows="50" class="form-control"><{$markdown|default:''}></textarea>
<{/if}>