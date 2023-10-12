<?php if(!empty($all_data)) : ?>
    <?php foreach($all_data as $key=>$val): ?>
        <tr id="row_for_<?php echo $val['emp_id']; ?>">
            <td><?php echo $val['emp_id']; ?></td>
            <td><?php echo $val['emp_fname']; ?></td>
            <td><?php echo $val['emp_lname']; ?></td>
            <td><?php echo $val['emp_email']; ?></td>
            <td><?php echo $val['designation']; ?></td>
            <td><a href="javascript:void(0)" onclick="edit_emp(<?php echo $val['emp_id']; ?>)">Edit</a> | <a href="javascript:void(0)" onclick="delete_emp(<?php echo $val['emp_id']; ?>)">Delete</a></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="5">No Data Found</td>
    </tr>
<?php endif; ?>