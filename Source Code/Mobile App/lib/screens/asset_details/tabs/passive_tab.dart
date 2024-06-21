import 'package:ats_system/screens/asset_details/custom_card_widget.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:scrollable_positioned_list/scrollable_positioned_list.dart';

class PassiveTab extends StatefulWidget {
  const PassiveTab({Key? key}) : super(key: key);

  @override
  State<PassiveTab> createState() => _PassiveTabState();
}

class _PassiveTabState extends State<PassiveTab> {
  final _scrollController = ScrollController();
  final ItemScrollController itemScrollController = ItemScrollController();
  final ScrollOffsetController scrollOffsetController =
      ScrollOffsetController();
  final ItemPositionsListener itemPositionsListener =
      ItemPositionsListener.create();
  final ScrollOffsetListener scrollOffsetListener =
      ScrollOffsetListener.create();

  @override
  Widget build(BuildContext context) {
    return Consumer<AssetDetailsProvider>(
      builder: (context, provider, state) {
        return Selector<AssetDetailsProvider, bool>(
            selector: (context, provider) => provider.isAssetDetailsLoading,
            builder: (context, isLoading, child) {
              return isLoading
                  ? const ProgressBar()
                  : Padding(
                      padding: const EdgeInsets.only(
                          left: 5.0, right: 5.0, bottom: 5.0),
                      child: Column(
                        children: [
                          Expanded(
                            child: Selector<AssetDetailsProvider,
                                    Map<String, List<AssetDataModel>>>(
                                selector: (context, provider) => provider.map,
                                builder: (context, data, child) {
                                  if (data.isEmpty)
                                    return const Center(
                                        child: Text(Strings.dataNotFound));
                                  return Scrollbar(
                                    controller: _scrollController,
                                    child: ScrollablePositionedList.builder(
                                      shrinkWrap: true,
                                      itemScrollController:
                                          itemScrollController,
                                      scrollOffsetController:
                                          scrollOffsetController,
                                      itemPositionsListener:
                                          itemPositionsListener,
                                      scrollOffsetListener:
                                          scrollOffsetListener,
                                      itemCount: data.keys.length,
                                      itemBuilder: (context, index) {
                                        return CustomCardWidget(
                                            map: data,
                                            index: index,
                                            itemScrollController:
                                                itemScrollController);
                                      },
                                    ),
                                  );
                                }),
                          ),
                        ],
                      ),
                    );
            });
      },
    );
  }
}
