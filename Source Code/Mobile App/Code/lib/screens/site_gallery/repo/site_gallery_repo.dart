import 'package:ats_system/api_client/retrofit_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_event.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_response_model/get_gallery_response_model.dart';
import 'package:injectable/injectable.dart';

abstract class SiteGalleryRepo {
  Future<GetGalleryResponseModel> getGallery(GetGallery request);
}

@Injectable(as: SiteGalleryRepo)
class Auth extends SiteGalleryRepo {
  final RetrofitClient authClient;
  Auth({
    required this.authClient,
  });

  @override
  Future<GetGalleryResponseModel> getGallery(GetGallery request) async {
    authClient.getDio.options.headers = {
      'Authorization': '${locator.get<SessionManager>().getToken()}'
    };
    return await authClient.getGallery(request.data);
  }
}
