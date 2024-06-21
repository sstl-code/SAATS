// coverage:ignore-file
// GENERATED CODE - DO NOT MODIFY BY HAND
// ignore_for_file: type=lint
// ignore_for_file: unused_element, deprecated_member_use, deprecated_member_use_from_same_package, use_function_type_syntax_for_parameters, unnecessary_const, avoid_init_to_null, invalid_override_different_default_values_named, prefer_expression_function_bodies, annotate_overrides, invalid_annotation_target, unnecessary_question_mark

part of 'capture_file_state.dart';

// **************************************************************************
// FreezedGenerator
// **************************************************************************

T _$identity<T>(T value) => value;

final _privateConstructorUsedError = UnsupportedError(
    'It seems like you constructed your class using `MyClass._()`. This constructor is only meant to be used by freezed and you are not supposed to need it nor use it.\nPlease check the documentation here for more information: https://github.com/rrousselGit/freezed#custom-getters-and-methods');

/// @nodoc
mixin _$CaptureFileState {
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function() initial,
    required TResult Function() loading,
    required TResult Function(dynamic data) success,
    required TResult Function() completed,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function()? initial,
    TResult? Function()? loading,
    TResult? Function(dynamic data)? success,
    TResult? Function()? completed,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function()? initial,
    TResult Function()? loading,
    TResult Function(dynamic data)? success,
    TResult Function()? completed,
    required TResult orElse(),
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(Initialising value) initial,
    required TResult Function(CamaInitialisationOnProgress value) loading,
    required TResult Function(CamaraInitialisedSuccess value) success,
    required TResult Function(TaskCompleted value) completed,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(Initialising value)? initial,
    TResult? Function(CamaInitialisationOnProgress value)? loading,
    TResult? Function(CamaraInitialisedSuccess value)? success,
    TResult? Function(TaskCompleted value)? completed,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(Initialising value)? initial,
    TResult Function(CamaInitialisationOnProgress value)? loading,
    TResult Function(CamaraInitialisedSuccess value)? success,
    TResult Function(TaskCompleted value)? completed,
    required TResult orElse(),
  }) =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $CaptureFileStateCopyWith<$Res> {
  factory $CaptureFileStateCopyWith(
          CaptureFileState value, $Res Function(CaptureFileState) then) =
      _$CaptureFileStateCopyWithImpl<$Res, CaptureFileState>;
}

/// @nodoc
class _$CaptureFileStateCopyWithImpl<$Res, $Val extends CaptureFileState>
    implements $CaptureFileStateCopyWith<$Res> {
  _$CaptureFileStateCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;
}

/// @nodoc
abstract class _$$InitialisingImplCopyWith<$Res> {
  factory _$$InitialisingImplCopyWith(
          _$InitialisingImpl value, $Res Function(_$InitialisingImpl) then) =
      __$$InitialisingImplCopyWithImpl<$Res>;
}

/// @nodoc
class __$$InitialisingImplCopyWithImpl<$Res>
    extends _$CaptureFileStateCopyWithImpl<$Res, _$InitialisingImpl>
    implements _$$InitialisingImplCopyWith<$Res> {
  __$$InitialisingImplCopyWithImpl(
      _$InitialisingImpl _value, $Res Function(_$InitialisingImpl) _then)
      : super(_value, _then);
}

/// @nodoc

class _$InitialisingImpl implements Initialising {
  _$InitialisingImpl();

  @override
  String toString() {
    return 'CaptureFileState.initial()';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType && other is _$InitialisingImpl);
  }

  @override
  int get hashCode => runtimeType.hashCode;

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function() initial,
    required TResult Function() loading,
    required TResult Function(dynamic data) success,
    required TResult Function() completed,
  }) {
    return initial();
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function()? initial,
    TResult? Function()? loading,
    TResult? Function(dynamic data)? success,
    TResult? Function()? completed,
  }) {
    return initial?.call();
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function()? initial,
    TResult Function()? loading,
    TResult Function(dynamic data)? success,
    TResult Function()? completed,
    required TResult orElse(),
  }) {
    if (initial != null) {
      return initial();
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(Initialising value) initial,
    required TResult Function(CamaInitialisationOnProgress value) loading,
    required TResult Function(CamaraInitialisedSuccess value) success,
    required TResult Function(TaskCompleted value) completed,
  }) {
    return initial(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(Initialising value)? initial,
    TResult? Function(CamaInitialisationOnProgress value)? loading,
    TResult? Function(CamaraInitialisedSuccess value)? success,
    TResult? Function(TaskCompleted value)? completed,
  }) {
    return initial?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(Initialising value)? initial,
    TResult Function(CamaInitialisationOnProgress value)? loading,
    TResult Function(CamaraInitialisedSuccess value)? success,
    TResult Function(TaskCompleted value)? completed,
    required TResult orElse(),
  }) {
    if (initial != null) {
      return initial(this);
    }
    return orElse();
  }
}

abstract class Initialising implements CaptureFileState {
  factory Initialising() = _$InitialisingImpl;
}

/// @nodoc
abstract class _$$CamaInitialisationOnProgressImplCopyWith<$Res> {
  factory _$$CamaInitialisationOnProgressImplCopyWith(
          _$CamaInitialisationOnProgressImpl value,
          $Res Function(_$CamaInitialisationOnProgressImpl) then) =
      __$$CamaInitialisationOnProgressImplCopyWithImpl<$Res>;
}

/// @nodoc
class __$$CamaInitialisationOnProgressImplCopyWithImpl<$Res>
    extends _$CaptureFileStateCopyWithImpl<$Res,
        _$CamaInitialisationOnProgressImpl>
    implements _$$CamaInitialisationOnProgressImplCopyWith<$Res> {
  __$$CamaInitialisationOnProgressImplCopyWithImpl(
      _$CamaInitialisationOnProgressImpl _value,
      $Res Function(_$CamaInitialisationOnProgressImpl) _then)
      : super(_value, _then);
}

/// @nodoc

class _$CamaInitialisationOnProgressImpl
    implements CamaInitialisationOnProgress {
  _$CamaInitialisationOnProgressImpl();

  @override
  String toString() {
    return 'CaptureFileState.loading()';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$CamaInitialisationOnProgressImpl);
  }

  @override
  int get hashCode => runtimeType.hashCode;

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function() initial,
    required TResult Function() loading,
    required TResult Function(dynamic data) success,
    required TResult Function() completed,
  }) {
    return loading();
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function()? initial,
    TResult? Function()? loading,
    TResult? Function(dynamic data)? success,
    TResult? Function()? completed,
  }) {
    return loading?.call();
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function()? initial,
    TResult Function()? loading,
    TResult Function(dynamic data)? success,
    TResult Function()? completed,
    required TResult orElse(),
  }) {
    if (loading != null) {
      return loading();
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(Initialising value) initial,
    required TResult Function(CamaInitialisationOnProgress value) loading,
    required TResult Function(CamaraInitialisedSuccess value) success,
    required TResult Function(TaskCompleted value) completed,
  }) {
    return loading(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(Initialising value)? initial,
    TResult? Function(CamaInitialisationOnProgress value)? loading,
    TResult? Function(CamaraInitialisedSuccess value)? success,
    TResult? Function(TaskCompleted value)? completed,
  }) {
    return loading?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(Initialising value)? initial,
    TResult Function(CamaInitialisationOnProgress value)? loading,
    TResult Function(CamaraInitialisedSuccess value)? success,
    TResult Function(TaskCompleted value)? completed,
    required TResult orElse(),
  }) {
    if (loading != null) {
      return loading(this);
    }
    return orElse();
  }
}

abstract class CamaInitialisationOnProgress implements CaptureFileState {
  factory CamaInitialisationOnProgress() = _$CamaInitialisationOnProgressImpl;
}

/// @nodoc
abstract class _$$CamaraInitialisedSuccessImplCopyWith<$Res> {
  factory _$$CamaraInitialisedSuccessImplCopyWith(
          _$CamaraInitialisedSuccessImpl value,
          $Res Function(_$CamaraInitialisedSuccessImpl) then) =
      __$$CamaraInitialisedSuccessImplCopyWithImpl<$Res>;
  @useResult
  $Res call({dynamic data});
}

/// @nodoc
class __$$CamaraInitialisedSuccessImplCopyWithImpl<$Res>
    extends _$CaptureFileStateCopyWithImpl<$Res, _$CamaraInitialisedSuccessImpl>
    implements _$$CamaraInitialisedSuccessImplCopyWith<$Res> {
  __$$CamaraInitialisedSuccessImplCopyWithImpl(
      _$CamaraInitialisedSuccessImpl _value,
      $Res Function(_$CamaraInitialisedSuccessImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = freezed,
  }) {
    return _then(_$CamaraInitialisedSuccessImpl(
      freezed == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as dynamic,
    ));
  }
}

/// @nodoc

class _$CamaraInitialisedSuccessImpl implements CamaraInitialisedSuccess {
  _$CamaraInitialisedSuccessImpl(this.data);

  @override
  final dynamic data;

  @override
  String toString() {
    return 'CaptureFileState.success(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$CamaraInitialisedSuccessImpl &&
            const DeepCollectionEquality().equals(other.data, data));
  }

  @override
  int get hashCode =>
      Object.hash(runtimeType, const DeepCollectionEquality().hash(data));

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$CamaraInitialisedSuccessImplCopyWith<_$CamaraInitialisedSuccessImpl>
      get copyWith => __$$CamaraInitialisedSuccessImplCopyWithImpl<
          _$CamaraInitialisedSuccessImpl>(this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function() initial,
    required TResult Function() loading,
    required TResult Function(dynamic data) success,
    required TResult Function() completed,
  }) {
    return success(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function()? initial,
    TResult? Function()? loading,
    TResult? Function(dynamic data)? success,
    TResult? Function()? completed,
  }) {
    return success?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function()? initial,
    TResult Function()? loading,
    TResult Function(dynamic data)? success,
    TResult Function()? completed,
    required TResult orElse(),
  }) {
    if (success != null) {
      return success(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(Initialising value) initial,
    required TResult Function(CamaInitialisationOnProgress value) loading,
    required TResult Function(CamaraInitialisedSuccess value) success,
    required TResult Function(TaskCompleted value) completed,
  }) {
    return success(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(Initialising value)? initial,
    TResult? Function(CamaInitialisationOnProgress value)? loading,
    TResult? Function(CamaraInitialisedSuccess value)? success,
    TResult? Function(TaskCompleted value)? completed,
  }) {
    return success?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(Initialising value)? initial,
    TResult Function(CamaInitialisationOnProgress value)? loading,
    TResult Function(CamaraInitialisedSuccess value)? success,
    TResult Function(TaskCompleted value)? completed,
    required TResult orElse(),
  }) {
    if (success != null) {
      return success(this);
    }
    return orElse();
  }
}

abstract class CamaraInitialisedSuccess implements CaptureFileState {
  factory CamaraInitialisedSuccess(final dynamic data) =
      _$CamaraInitialisedSuccessImpl;

  dynamic get data;
  @JsonKey(ignore: true)
  _$$CamaraInitialisedSuccessImplCopyWith<_$CamaraInitialisedSuccessImpl>
      get copyWith => throw _privateConstructorUsedError;
}

/// @nodoc
abstract class _$$TaskCompletedImplCopyWith<$Res> {
  factory _$$TaskCompletedImplCopyWith(
          _$TaskCompletedImpl value, $Res Function(_$TaskCompletedImpl) then) =
      __$$TaskCompletedImplCopyWithImpl<$Res>;
}

/// @nodoc
class __$$TaskCompletedImplCopyWithImpl<$Res>
    extends _$CaptureFileStateCopyWithImpl<$Res, _$TaskCompletedImpl>
    implements _$$TaskCompletedImplCopyWith<$Res> {
  __$$TaskCompletedImplCopyWithImpl(
      _$TaskCompletedImpl _value, $Res Function(_$TaskCompletedImpl) _then)
      : super(_value, _then);
}

/// @nodoc

class _$TaskCompletedImpl implements TaskCompleted {
  _$TaskCompletedImpl();

  @override
  String toString() {
    return 'CaptureFileState.completed()';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType && other is _$TaskCompletedImpl);
  }

  @override
  int get hashCode => runtimeType.hashCode;

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function() initial,
    required TResult Function() loading,
    required TResult Function(dynamic data) success,
    required TResult Function() completed,
  }) {
    return completed();
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function()? initial,
    TResult? Function()? loading,
    TResult? Function(dynamic data)? success,
    TResult? Function()? completed,
  }) {
    return completed?.call();
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function()? initial,
    TResult Function()? loading,
    TResult Function(dynamic data)? success,
    TResult Function()? completed,
    required TResult orElse(),
  }) {
    if (completed != null) {
      return completed();
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(Initialising value) initial,
    required TResult Function(CamaInitialisationOnProgress value) loading,
    required TResult Function(CamaraInitialisedSuccess value) success,
    required TResult Function(TaskCompleted value) completed,
  }) {
    return completed(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(Initialising value)? initial,
    TResult? Function(CamaInitialisationOnProgress value)? loading,
    TResult? Function(CamaraInitialisedSuccess value)? success,
    TResult? Function(TaskCompleted value)? completed,
  }) {
    return completed?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(Initialising value)? initial,
    TResult Function(CamaInitialisationOnProgress value)? loading,
    TResult Function(CamaraInitialisedSuccess value)? success,
    TResult Function(TaskCompleted value)? completed,
    required TResult orElse(),
  }) {
    if (completed != null) {
      return completed(this);
    }
    return orElse();
  }
}

abstract class TaskCompleted implements CaptureFileState {
  factory TaskCompleted() = _$TaskCompletedImpl;
}
