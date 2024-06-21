import 'package:freezed_annotation/freezed_annotation.dart';

part 'capture_file_state.freezed.dart';

@freezed
class CaptureFileState with _$CaptureFileState {
  factory CaptureFileState.initial() = Initialising;

  factory CaptureFileState.loading() = CamaInitialisationOnProgress;

  factory CaptureFileState.success(dynamic data) = CamaraInitialisedSuccess;

  factory CaptureFileState.completed() = TaskCompleted;
}
