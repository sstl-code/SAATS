// coverage:ignore-file
// GENERATED CODE - DO NOT MODIFY BY HAND
// ignore_for_file: type=lint
// ignore_for_file: unused_element, deprecated_member_use, deprecated_member_use_from_same_package, use_function_type_syntax_for_parameters, unnecessary_const, avoid_init_to_null, invalid_override_different_default_values_named, prefer_expression_function_bodies, annotate_overrides, invalid_annotation_target, unnecessary_question_mark

part of 'capture_file_event.dart';

// **************************************************************************
// FreezedGenerator
// **************************************************************************

T _$identity<T>(T value) => value;

final _privateConstructorUsedError = UnsupportedError(
    'It seems like you constructed your class using `MyClass._()`. This constructor is only meant to be used by freezed and you are not supposed to need it nor use it.\nPlease check the documentation here for more information: https://github.com/rrousselGit/freezed#custom-getters-and-methods');

/// @nodoc
mixin _$CaptureFileEvent {
  Object get data => throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(InitCameraControllerEvent data)
        initCameraController,
    required TResult Function(InitVideoPlayerControllerEvent data)
        initVideoPlayeroOntroller,
    required TResult Function(ResetEvent data) resetEvent,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(InitCameraControllerEvent data)? initCameraController,
    TResult? Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult? Function(ResetEvent data)? resetEvent,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(InitCameraControllerEvent data)? initCameraController,
    TResult Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult Function(ResetEvent data)? resetEvent,
    required TResult orElse(),
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(InitCameraController value) initCameraController,
    required TResult Function(InitVideoPlayerController value)
        initVideoPlayeroOntroller,
    required TResult Function(Reset value) resetEvent,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(InitCameraController value)? initCameraController,
    TResult? Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult? Function(Reset value)? resetEvent,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(InitCameraController value)? initCameraController,
    TResult Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult Function(Reset value)? resetEvent,
    required TResult orElse(),
  }) =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $CaptureFileEventCopyWith<$Res> {
  factory $CaptureFileEventCopyWith(
          CaptureFileEvent value, $Res Function(CaptureFileEvent) then) =
      _$CaptureFileEventCopyWithImpl<$Res, CaptureFileEvent>;
}

/// @nodoc
class _$CaptureFileEventCopyWithImpl<$Res, $Val extends CaptureFileEvent>
    implements $CaptureFileEventCopyWith<$Res> {
  _$CaptureFileEventCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;
}

/// @nodoc
abstract class _$$InitCameraControllerImplCopyWith<$Res> {
  factory _$$InitCameraControllerImplCopyWith(_$InitCameraControllerImpl value,
          $Res Function(_$InitCameraControllerImpl) then) =
      __$$InitCameraControllerImplCopyWithImpl<$Res>;
  @useResult
  $Res call({InitCameraControllerEvent data});
}

/// @nodoc
class __$$InitCameraControllerImplCopyWithImpl<$Res>
    extends _$CaptureFileEventCopyWithImpl<$Res, _$InitCameraControllerImpl>
    implements _$$InitCameraControllerImplCopyWith<$Res> {
  __$$InitCameraControllerImplCopyWithImpl(_$InitCameraControllerImpl _value,
      $Res Function(_$InitCameraControllerImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = null,
  }) {
    return _then(_$InitCameraControllerImpl(
      null == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as InitCameraControllerEvent,
    ));
  }
}

/// @nodoc

class _$InitCameraControllerImpl implements InitCameraController {
  _$InitCameraControllerImpl(this.data);

  @override
  final InitCameraControllerEvent data;

  @override
  String toString() {
    return 'CaptureFileEvent.initCameraController(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$InitCameraControllerImpl &&
            (identical(other.data, data) || other.data == data));
  }

  @override
  int get hashCode => Object.hash(runtimeType, data);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$InitCameraControllerImplCopyWith<_$InitCameraControllerImpl>
      get copyWith =>
          __$$InitCameraControllerImplCopyWithImpl<_$InitCameraControllerImpl>(
              this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(InitCameraControllerEvent data)
        initCameraController,
    required TResult Function(InitVideoPlayerControllerEvent data)
        initVideoPlayeroOntroller,
    required TResult Function(ResetEvent data) resetEvent,
  }) {
    return initCameraController(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(InitCameraControllerEvent data)? initCameraController,
    TResult? Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult? Function(ResetEvent data)? resetEvent,
  }) {
    return initCameraController?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(InitCameraControllerEvent data)? initCameraController,
    TResult Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult Function(ResetEvent data)? resetEvent,
    required TResult orElse(),
  }) {
    if (initCameraController != null) {
      return initCameraController(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(InitCameraController value) initCameraController,
    required TResult Function(InitVideoPlayerController value)
        initVideoPlayeroOntroller,
    required TResult Function(Reset value) resetEvent,
  }) {
    return initCameraController(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(InitCameraController value)? initCameraController,
    TResult? Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult? Function(Reset value)? resetEvent,
  }) {
    return initCameraController?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(InitCameraController value)? initCameraController,
    TResult Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult Function(Reset value)? resetEvent,
    required TResult orElse(),
  }) {
    if (initCameraController != null) {
      return initCameraController(this);
    }
    return orElse();
  }
}

abstract class InitCameraController implements CaptureFileEvent {
  factory InitCameraController(final InitCameraControllerEvent data) =
      _$InitCameraControllerImpl;

  @override
  InitCameraControllerEvent get data;
  @JsonKey(ignore: true)
  _$$InitCameraControllerImplCopyWith<_$InitCameraControllerImpl>
      get copyWith => throw _privateConstructorUsedError;
}

/// @nodoc
abstract class _$$InitVideoPlayerControllerImplCopyWith<$Res> {
  factory _$$InitVideoPlayerControllerImplCopyWith(
          _$InitVideoPlayerControllerImpl value,
          $Res Function(_$InitVideoPlayerControllerImpl) then) =
      __$$InitVideoPlayerControllerImplCopyWithImpl<$Res>;
  @useResult
  $Res call({InitVideoPlayerControllerEvent data});
}

/// @nodoc
class __$$InitVideoPlayerControllerImplCopyWithImpl<$Res>
    extends _$CaptureFileEventCopyWithImpl<$Res,
        _$InitVideoPlayerControllerImpl>
    implements _$$InitVideoPlayerControllerImplCopyWith<$Res> {
  __$$InitVideoPlayerControllerImplCopyWithImpl(
      _$InitVideoPlayerControllerImpl _value,
      $Res Function(_$InitVideoPlayerControllerImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = null,
  }) {
    return _then(_$InitVideoPlayerControllerImpl(
      null == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as InitVideoPlayerControllerEvent,
    ));
  }
}

/// @nodoc

class _$InitVideoPlayerControllerImpl implements InitVideoPlayerController {
  _$InitVideoPlayerControllerImpl(this.data);

  @override
  final InitVideoPlayerControllerEvent data;

  @override
  String toString() {
    return 'CaptureFileEvent.initVideoPlayeroOntroller(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$InitVideoPlayerControllerImpl &&
            (identical(other.data, data) || other.data == data));
  }

  @override
  int get hashCode => Object.hash(runtimeType, data);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$InitVideoPlayerControllerImplCopyWith<_$InitVideoPlayerControllerImpl>
      get copyWith => __$$InitVideoPlayerControllerImplCopyWithImpl<
          _$InitVideoPlayerControllerImpl>(this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(InitCameraControllerEvent data)
        initCameraController,
    required TResult Function(InitVideoPlayerControllerEvent data)
        initVideoPlayeroOntroller,
    required TResult Function(ResetEvent data) resetEvent,
  }) {
    return initVideoPlayeroOntroller(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(InitCameraControllerEvent data)? initCameraController,
    TResult? Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult? Function(ResetEvent data)? resetEvent,
  }) {
    return initVideoPlayeroOntroller?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(InitCameraControllerEvent data)? initCameraController,
    TResult Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult Function(ResetEvent data)? resetEvent,
    required TResult orElse(),
  }) {
    if (initVideoPlayeroOntroller != null) {
      return initVideoPlayeroOntroller(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(InitCameraController value) initCameraController,
    required TResult Function(InitVideoPlayerController value)
        initVideoPlayeroOntroller,
    required TResult Function(Reset value) resetEvent,
  }) {
    return initVideoPlayeroOntroller(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(InitCameraController value)? initCameraController,
    TResult? Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult? Function(Reset value)? resetEvent,
  }) {
    return initVideoPlayeroOntroller?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(InitCameraController value)? initCameraController,
    TResult Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult Function(Reset value)? resetEvent,
    required TResult orElse(),
  }) {
    if (initVideoPlayeroOntroller != null) {
      return initVideoPlayeroOntroller(this);
    }
    return orElse();
  }
}

abstract class InitVideoPlayerController implements CaptureFileEvent {
  factory InitVideoPlayerController(final InitVideoPlayerControllerEvent data) =
      _$InitVideoPlayerControllerImpl;

  @override
  InitVideoPlayerControllerEvent get data;
  @JsonKey(ignore: true)
  _$$InitVideoPlayerControllerImplCopyWith<_$InitVideoPlayerControllerImpl>
      get copyWith => throw _privateConstructorUsedError;
}

/// @nodoc
abstract class _$$ResetImplCopyWith<$Res> {
  factory _$$ResetImplCopyWith(
          _$ResetImpl value, $Res Function(_$ResetImpl) then) =
      __$$ResetImplCopyWithImpl<$Res>;
  @useResult
  $Res call({ResetEvent data});
}

/// @nodoc
class __$$ResetImplCopyWithImpl<$Res>
    extends _$CaptureFileEventCopyWithImpl<$Res, _$ResetImpl>
    implements _$$ResetImplCopyWith<$Res> {
  __$$ResetImplCopyWithImpl(
      _$ResetImpl _value, $Res Function(_$ResetImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = null,
  }) {
    return _then(_$ResetImpl(
      null == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as ResetEvent,
    ));
  }
}

/// @nodoc

class _$ResetImpl implements Reset {
  _$ResetImpl(this.data);

  @override
  final ResetEvent data;

  @override
  String toString() {
    return 'CaptureFileEvent.resetEvent(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$ResetImpl &&
            (identical(other.data, data) || other.data == data));
  }

  @override
  int get hashCode => Object.hash(runtimeType, data);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$ResetImplCopyWith<_$ResetImpl> get copyWith =>
      __$$ResetImplCopyWithImpl<_$ResetImpl>(this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(InitCameraControllerEvent data)
        initCameraController,
    required TResult Function(InitVideoPlayerControllerEvent data)
        initVideoPlayeroOntroller,
    required TResult Function(ResetEvent data) resetEvent,
  }) {
    return resetEvent(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(InitCameraControllerEvent data)? initCameraController,
    TResult? Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult? Function(ResetEvent data)? resetEvent,
  }) {
    return resetEvent?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(InitCameraControllerEvent data)? initCameraController,
    TResult Function(InitVideoPlayerControllerEvent data)?
        initVideoPlayeroOntroller,
    TResult Function(ResetEvent data)? resetEvent,
    required TResult orElse(),
  }) {
    if (resetEvent != null) {
      return resetEvent(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(InitCameraController value) initCameraController,
    required TResult Function(InitVideoPlayerController value)
        initVideoPlayeroOntroller,
    required TResult Function(Reset value) resetEvent,
  }) {
    return resetEvent(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(InitCameraController value)? initCameraController,
    TResult? Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult? Function(Reset value)? resetEvent,
  }) {
    return resetEvent?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(InitCameraController value)? initCameraController,
    TResult Function(InitVideoPlayerController value)?
        initVideoPlayeroOntroller,
    TResult Function(Reset value)? resetEvent,
    required TResult orElse(),
  }) {
    if (resetEvent != null) {
      return resetEvent(this);
    }
    return orElse();
  }
}

abstract class Reset implements CaptureFileEvent {
  factory Reset(final ResetEvent data) = _$ResetImpl;

  @override
  ResetEvent get data;
  @JsonKey(ignore: true)
  _$$ResetImplCopyWith<_$ResetImpl> get copyWith =>
      throw _privateConstructorUsedError;
}
