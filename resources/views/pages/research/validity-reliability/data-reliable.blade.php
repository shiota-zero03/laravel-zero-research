<div>
    <div class="card p-md-3 p-2 mb-2">
        <div class="text-center text-uppercase"><strong>Reliability Data</strong></div>
    </div>
    <div class="card p-md-3 p-2 mb-2">
        <div>
            <div class="my-1">
                <div>
                    <h5 class="card-title">
                        Formula of Item Varians ( s<sub>i</sub><sup>2</sup> )
                    </h5>
                    <div class="border border-white py-md-4 py-2 px-2 rounded">
                        <div class="text-center">
                            @include('pages.research.validity-reliability.formula-varians-item')
                        </div>
                        <br />
                    </div>
                </div>
                <br />
                <div>
                    <h5 class="card-title">
                        Formula of Total Varians ( s<sub>t</sub><sup>2</sup> )
                    </h5>
                    <div class="border border-white py-md-4 py-2 px-2 rounded">
                        <div class="text-center">
                            @include('pages.research.validity-reliability.formula-varians-total')
                        </div>
                        <br />
                    </div>
                </div>
                <br />
                <div>
                    <h5 class="card-title">
                        Formula of Reliability Test ( r )
                    </h5>
                    <div class="border border-white py-md-4 py-2 px-2 rounded">
                        <div class="text-center">
                            @include('pages.research.validity-reliability.formula-reliability')
                        </div>
                        <br />
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
                                        <th>Value</th>
                                    </tr>
                                    <tr>
                                        <td>n</td>
                                        <td>{{ $data['n'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>k</td>
                                        <td>{{ count($data['sigma_x']) }}</td>
                                    </tr>

                                    @foreach ($data['sigma_x'] as $itx => $dtx)
                                        <tr>
                                            <td>&sum; x<sub>{{ $itx + 1 }}</td>
                                            <td>{{ $dtx }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($data['sigma_xr'] as $itxr => $dtxr)
                                        <tr>
                                            <td>&sum; ( x<sub>{{ $itxr + 1 }}</sub><sup>2</sup> )</td>
                                            <td>{{ $dtxr }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td>&sum; x<sub>t</td>
                                        <td>{{ $data['sigma_y'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>&sum; ( x<sub>t</sub><sup>2</sup> )</td>
                                        <td>{{ $data['sigma_yy'] }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        @include('pages.research.validity-reliability.count-reliability')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
