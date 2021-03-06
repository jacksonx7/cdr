<div class="col-md-4 col-sm-12 col-xs-12">
    <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
            <h2>Количество звонков по номерам</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link">Свернуть <i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="" style="width:100%">
                <tr>
                    <th style="width:37%;">
                        <p>&nbsp;</p>
                    </th>
                    <th>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p class="">Городской номер</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p class="">Количство звонков</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <canvas id="piecanvas" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                        <table class="tile_info">
                            <?php $colornames = ['blue','green','purple','aero','red','dark'] ?>
                            @for( $i=0; $i<count($statsByDst); $i++)
                                <tr>
                                    <td>
                                        <p><i class="fa fa-square {{ $colornames[$i] }}"></i>{{ $statsByDst[$i]->dst }} </p>
                                    </td>
                                    <td>{{ $statsByDst[$i]->amount }}</td>
                                </tr>
                            @endfor
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@include('vendor.Chart')

@push('scripts')
<script>
    $(document).ready(function() {

        // Круговой график
        new Chart($('#piecanvas'), {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
                labels: [
                    @foreach($statsByDst as $dst)
                    "{{ $dst->dst }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($statsByDst as $dst)
                        {{ $dst->amount }},
                        @endforeach
                    ],
                    backgroundColor: [
                        "#3498DB",
                        "#26B99A",
                        "#9B59B6",
                        "#BDC3C7",
                        "#E74C3C"
                    ],
                    hoverBackgroundColor: [
                        "#49A9EA",
                        "#36CAAB",
                        "#B370CF",
                        "#CFD4D8",
                        "#E95E4F"
                    ]
                }]
            },
            options: {
                legend: false,
                responsive: false
            }
        });

    });
</script>
@endpush