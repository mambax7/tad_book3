<{foreach from=$block item=book}>
  <div>
    <div>
      <span class="label label-success">
        <a href="<{$xoops_url}>/modules/tad_book3/index.php?tbsn=<{$book.tbsn}>" style="color: white;"><{$book.book_title}></a>
      </span>
    </div>
    <p>
      <{$book.doc_sort}>
      <a href="<{$xoops_url}>/modules/tad_book3/page.php?tbdsn=<{$book.tbdsn}>"><{$book.title}></a>
    </p>
  </div>
<{/foreach}>