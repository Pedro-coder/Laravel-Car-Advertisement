<table class="table table-striped" id="excel_trans">
    <thead>
      <tr>
        <th>Date</th>
        <th>Descriptions</th>
        <th>Desposits/Credits</th>
        <th>Withdrawals/Debits</th>
        <th>Ending Daily Balance</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($posted_transactions as $key=>$value): ?>
            <tr>
                <td>{{$value['datwise']}}</td>
                <td>{{$value['description']}}</td>
                <td>{{$value['amount']}}</td>
                <td>{{$value['withdraw']}}</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>