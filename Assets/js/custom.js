jQuery(document).ready(function(){
    loadData(1)
});

loadData = (page) => {
    $.ajax({
        url  : 'index.php',
        data : { action : 'get_list',page: page },
        type : 'POST' ,
        success : function( data ) {
            jQuery('#emp_data').html(data);
        }
    });
}
validateEmail = ($email)=> {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}
cancel_emp_data = ()=>{
    jQuery('#emp_form')[0].reset();
    jQuery('#emp_id').val(0);
    jQuery('#save_btn').html('Save');
}
save_emp_data = (event)=>{
    let fname = jQuery('#emp_first_name').val();
    let lname = jQuery('#emp_last_name').val();
    let email = jQuery('#emp_email').val();
    let degignation = jQuery('#emp_designation').val();
    if(fname.trim() == ''){
        alert("Please enter first name");
    }else if(lname.trim() == ''){
        alert("Please enter last name");
    }else if(email.trim() == ''){
        alert("Please enter email address");
    }else if(!validateEmail(email)){
        alert("Please enter valid email address");
    }else if(degignation.trim() == ''){
        alert("Please enter designation");
    }else{
        $.ajax({
            url  : 'index.php',
            data : jQuery('#emp_form').serialize(),
            type : 'POST' ,
            success : function( data ) {
                let response = JSON.parse(data);
                if(response.status == 200){
                    
                    loadData(1);
                    cancel_emp_data();
                }else{
                    alert(response['message']);
                }
            }
        });
    }
    return false;
}

edit_emp = (emp_id)=>{
    $.ajax({
        url  : 'index.php',
        data : { action : 'get_emp_details',emp_id: emp_id },
        type : 'POST' ,
        success : function( data ) {
            let response = JSON.parse(data);
            
            jQuery('#emp_id').val(response[0]);
            jQuery('#emp_first_name').val(response[1]);
            jQuery('#emp_last_name').val(response[2]);
            jQuery('#emp_email').val(response[3]);
            jQuery('#emp_designation').val(response[4]);

            jQuery('#save_btn').html('Update');
        }
    });
}

delete_emp = (emp_id) =>{
    let cnf = confirm("Are you sure to delete this employee ?");
    if(cnf){
        $.ajax({
            url  : 'index.php',
            data : { action : 'delete_emp',emp_id: emp_id },
            type : 'POST' ,
            success : function( data ) {
                let response = JSON.parse(data);
                if(response['status'] == 200){
                    loadData(1);
                    cancel_emp_data();
                }
            }
        });
    }
    
}