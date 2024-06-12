<div>
    <div class="card p-md-3 p-2 mb-2">
        <div class="text-center text-uppercase"><strong>Validity Data</strong></div>
    </div>
    <div class="card p-md-3 p-2 mb-2">
        <div>
            <div class="my-1">
                <h5 class="card-title">
                    Formula of Correlation Coefficient (r)
                </h5>
                <div class="border border-white py-md-4 py-2 px-2 rounded">
                    <div class="text-center">
                        @include('pages.research.validity-reliability.formula-korelation')
                    </div>
                    <br />
                    <div>
                        <small>Description:</small><br />
                        <ul>
                            <li><small>r = Correlation Coefficient</small></li>
                            <li><small>n = Sample/Respondent Total</small></li>
                            <li><small>x = Question Score</small></li>
                            <li><small>y = Total Score</small></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-md-3 p-2 mb-2">
        <div>
            <div class="my-1">
                <h5 class="card-title">
                    Solution
                </h5>
                <div class="border border-white py-md-4 py-2 px-2 rounded">
                    <div>
                        <div class="px-md-5 py-md-5 py-2 table-responsive">
                            <table class="table table-bordered border-white">
                                <tbody>
                                    <tr class="bg-dark">
                                        <th colspan="5" class="text-center">Known Data</th>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <th>Type</th>
                                        <th colspan="4">Value</th>
                                    </tr>
                                    <tr>
                                        <td>n</td>
                                        <td colspan="4">{{ $data['n'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>r</td>
                                        <td colspan="4">{{ $data['r_table'] }}</td>
                                    </tr>
                                    <tr class="bg-secondary">
                                        <th>Type</th>
                                        @foreach ($data['sigma_x'] as $index => $dt)
                                            <th>Data {{ $index + 1 }}</th>
                                        @endforeach
                                        <th>Total</th>
                                    </tr>
                                    <tr>
                                        <td>&sum;x</td>
                                        @foreach ($data['sigma_x'] as $dtx)
                                            <td>{{ $dtx }}</td>
                                        @endforeach
                                        <td class="bg-dark"></td>
                                    </tr>
                                    <tr>
                                        <td>&sum;y</td>
                                        <td colspan="{{ (count( $data['sigma_x'])) }}" class="bg-dark"></td>
                                        <td>{{ $data['sigma_y'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>&sum;x<sup>2</sup></td>
                                        @foreach ($data['sigma_xx'] as $dtxx)
                                            <td>{{ $dtxx }}</td>
                                        @endforeach
                                        <td class="bg-dark"></td>
                                    </tr>
                                    <tr>
                                        <td>&sum;y<sup>2</sup></td>
                                        <td colspan="{{ (count( $data['sigma_x'])) }}" class="bg-dark"></td>
                                        <td>{{ $data['sigma_yy'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>&sum;xy</td>
                                        @foreach ($data['sigma_xy'] as $dtxy)
                                            <td>{{ $dtxy }}</td>
                                        @endforeach
                                        <td class="bg-dark"></td>
                                    </tr>
                                    <tr>
                                        <td>( &sum;x )<sup>2</sup></td>
                                        @foreach ($data['sigmax_sigmax'] as $dtx2)
                                            <td>{{ $dtx2 }}</td>
                                        @endforeach
                                        <td class="bg-dark"></td>
                                    </tr>
                                    <tr>
                                        <td>( &sum;y )<sup>2</sup></td>
                                        <td colspan="{{ (count( $data['sigma_x'])) }}" class="bg-dark"></td>
                                        <td>{{ $data['sigmay_sigmay'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        @include('pages.research.validity-reliability.count-korelation')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
