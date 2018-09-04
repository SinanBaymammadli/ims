import $ from "jquery";

const printBtn = $("#js-print-btn");

printBtn.click(() => {
  const prtContent = document.getElementById("print");
  const WinPrint = window.open(
    "",
    "",
    "left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0"
  );
  WinPrint.document.write(prtContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
});
